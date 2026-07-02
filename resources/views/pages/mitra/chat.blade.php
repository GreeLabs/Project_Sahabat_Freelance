<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Chat | Sahabat Freelance</title>  
    @include('layouts.mitra.style')  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <style>  
        .chat-wrapper {
            background-color: var(--nb-paper);
            border: var(--nb-border-strong);
            box-shadow: var(--nb-shadow);
            display: flex;
            height: calc(100vh - 150px);
            min-height: 500px;
        }
        .user-list {  
            border-right: var(--nb-border-strong);  
            background-color: var(--nb-surface);
            overflow-y: auto;  
            width: 300px;
            flex-shrink: 0;
        }  
        .user-item {  
            display: flex;  
            align-items: center;  
            padding: 15px;  
            cursor: pointer;  
            border-bottom: var(--nb-border);
            transition: background 0.2s;
        }  
        .user-item:hover {  
            background-color: var(--nb-soft);  
        }  
        .user-avatar {  
            width: 45px;  
            height: 45px;  
            border-radius: 0;  
            border: var(--nb-border);
            box-shadow: 2px 2px 0 var(--nb-ink);
            margin-right: 15px;  
        }  
        .chat-area {  
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            background-color: var(--nb-paper);
        }  
        .chat-header {  
            display: flex;  
            align-items: center;  
            padding: 15px 20px;
            border-bottom: var(--nb-border-strong);
            background-color: var(--nb-primary);
        }  
        .chat-header img {  
            width: 45px;  
            height: 45px;  
            border-radius: 0;  
            border: var(--nb-border);
            box-shadow: 2px 2px 0 var(--nb-ink);
            margin-right: 15px;  
            background: white;
        }  
        .chat-header .status {  
            color: var(--nb-ink);  
            font-size: 0.9rem;  
            font-family: var(--nb-font-ui);
            font-weight: bold;
        }  
        .messages-container {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: var(--nb-paper);
        }
        .message {  
            margin-bottom: 20px;  
            display: flex;  
            flex-direction: column;
        }  
        .message.user {  
            align-items: flex-end;  
        }  
        .message.other {  
            align-items: flex-start;  
        }  
        .message-content {  
            padding: 12px 18px;  
            max-width: 75%;  
            font-family: var(--nb-font-ui);
            font-size: 0.95rem;
            border: var(--nb-border);
            border-radius: 0;
            box-shadow: 3px 3px 0 var(--nb-ink);
        }  
        .message.user .message-content {  
            background-color: var(--nb-primary);  
            color: var(--nb-ink);  
            font-weight: 500;
        }  
        .message.other .message-content {  
            background-color: var(--nb-surface);  
            color: var(--nb-ink);  
            font-weight: 500;
        }  
        .chat-input-area {
            padding: 15px;
            border-top: var(--nb-border-strong);
            background-color: var(--nb-surface);
            display: flex;
            gap: 10px;
        }
    </style>  
</head>  
<body>  
    <div class="container-scroller">  
        @include('layouts.mitra.navbar')  
        <div class="container-fluid page-body-wrapper">  
            @include('layouts.mitra.sidebar')  
            <div class="main-panel">  
                <div class="content-wrapper">  
                    <div class="row">  
                        <div class="col-12">  
                            <h2 class="page-title">Chat</h2>  
                        </div>  
                    </div>  
                    <div class="row">  
                        <div class="col-12">  
                            <div class="chat-wrapper">  
                                <div class="user-list">  
                                    <!-- User List -->  
                                    @if($users->isEmpty())  
                                        <div class="p-3 text-center" style="font-family: var(--nb-font-ui); font-weight: 500;">No users found.</div>  
                                    @else  
                                        @foreach($users as $user)  
                                            <div class="user-item" onclick="selectUser('{{ addslashes($user->id) }}', '{{ addslashes($user->name) }}')">  
                                                <img src="{{ asset('mitra/images/people1.jpg') }}" class="user-avatar" alt="{{ $user->name }}">  
                                                <div>  
                                                    <strong style="font-family: var(--nb-font-display); font-size: 1.1rem;">{{ $user->name }}</strong>  
                                                    <p style="margin: 0; font-size: 0.85rem; font-family: var(--nb-font-ui);">Pesan terakhir dari {{ $user->name }}</p>  
                                                </div>  
                                            </div>  
                                        @endforeach  
                                    @endif  
                                </div>  
                                <div class="chat-area" id="chatArea">  
                                    <!-- Chat Header -->  
                                    <div class="chat-header">  
                                        <img src="{{ asset('mitra/images/people1.jpg') }}" class="user-avatar" alt="Current User" style="border-radius: 0; margin-bottom: 0;">  
                                        <div>  
                                            <strong id="currentUserName" style="font-family: var(--nb-font-display); font-size: 1.25rem;">Pilih Pengguna</strong>  
                                            <div class="status" style="display: flex; align-items: center; gap: 5px;">
                                                <div style="width: 8px; height: 8px; background-color: var(--nb-success); border: 2px solid var(--nb-ink); border-radius: 50%;"></div>
                                                Aktif
                                            </div>  
                                        </div>  
                                    </div>  
                                    <!-- Chat Messages -->  
                                    <div class="messages-container" id="chatMessages">
                                        <!-- Messages will be injected here -->
                                    </div>  
                                    <!-- Chat Input -->
                                    <div class="chat-input-area">  
                                        <input type="text" class="nb-input" style="flex-grow: 1;" placeholder="Ketik pesan..." id="messageInput">  
                                        <button class="nb-btn btn-primary" type="button" id="sendButton">Kirim</button>  
                                    </div>  
                                </div>  
                            </div>
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- Footer -->  
        <footer class="footer">  
            <div class="d-sm-flex justify-content-center justify-content-sm-between">  
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. Freelance.id. All rights reserved.</span>  
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Dibuat dengan <i class="ti-heart text-danger ml-1"></i></span>  
            </div>  
            <div class="d-sm-flex justify-content-center justify-content-sm-between">  
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Didistribusikan oleh <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>   
            </div>  
        </footer>  
    </div>  
    <script>  
        let currentUserId = {{ Auth::guard('mitra')->user()->id }}; // Set this to the logged-in user's ID  
        let selectedUserId = null;  
  
        function selectUser(userId, userName) {  
            selectedUserId = userId;  
            document.getElementById('currentUserName').innerText = userName;  
  
            // Fetch messages for the selected user  
            fetch(`/chat/messages/${userId}`)  
                .then(response => {  
                    if (!response.ok) {  
                        throw new Error('Network response was not ok ' + response.statusText);  
                    }  
                    return response.json();  
                })  
                .then(messages => {  
                    const chatMessages = document.getElementById('chatMessages');  
                    chatMessages.innerHTML = ''; // Clear previous messages  
  
                    messages.forEach(message => {  
                        const messageDiv = document.createElement('div');  
                        messageDiv.className = `message ${message.sender_id === currentUserId ? 'user' : 'other'}`;  
                        const messageContent = document.createElement('div');
                        messageContent.className = 'message-content';
                        messageContent.textContent = message.message;
                        messageDiv.appendChild(messageContent);
                        chatMessages.appendChild(messageDiv);  
                    });  
  
                    // Scroll to the bottom of the chat area  
                    chatMessages.scrollTop = chatMessages.scrollHeight;  
                })  
                .catch(error => {  
                    console.error('There was a problem with the fetch operation:', error);  
                });  
        }  
  
        document.getElementById('sendButton').addEventListener('click', function() {  
            const messageInput = document.getElementById('messageInput');  
            const message = messageInput.value;  
  
            if (message && selectedUserId) {  
                fetch('/chat/send', {  
                    method: 'POST',  
                    headers: {  
                        'Content-Type': 'application/json',  
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'  
                    },  
                    body: JSON.stringify({  
                        sender_id: currentUserId,  
                        receiver_id: selectedUserId,  
                        message: message  
                    })  
                })  
                .then(response => {  
                    if (!response.ok) {  
                        throw new Error('Network response was not ok ' + response.statusText);  
                    }  
                    return response.json();  
                })  
                .then(data => {  
                    if (data.success) {  
                        messageInput.value = ''; // Clear input  
  
                        // Add the sent message to the chat area  
                        const chatMessages = document.getElementById('chatMessages');  
                        const messageDiv = document.createElement('div');  
                        messageDiv.className = 'message user';  
                        const messageContent = document.createElement('div');
                        messageContent.className = 'message-content';
                        messageContent.textContent = message;
                        messageDiv.appendChild(messageContent);
                        chatMessages.appendChild(messageDiv);  
  
                        // Scroll to the bottom of the chat area  
                        chatMessages.scrollTop = chatMessages.scrollHeight;  
                    }  
                })  
                .catch(error => {  
                    console.error('There was a problem with the fetch operation:', error);  
                });  
            }  
        });  
    </script>  
</body>  
</html>  
