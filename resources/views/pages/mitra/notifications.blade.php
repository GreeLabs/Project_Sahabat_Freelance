<!DOCTYPE html>  
   <html lang="en">  
   <head>  
       @include('layouts.mitra.style')  
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
       <style>  
           .notification-card {  
               border-radius: 5px;  
               padding: 15px;  
               display: flex; /* Menggunakan flexbox untuk tata letak */  
               align-items: center; /* Memusatkan ikon dan teks secara vertikal */  
           }  
           .notification-icon {  
               font-size: 46px; /* Ukuran ikon */  
               margin-right: 30px; /* Jarak antara ikon dan teks */  
               color: #1e88e5; /* Warna ikon */  
           }  
           .notification-title {  
               font-weight: bold;  
           }  
           .notification-time {  
               font-size: 0.9rem;  
               color: #888;  
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
                           <div class="col-12 mb-3">  
                               <h2 class="page-title">Notifications</h2>  
                           </div>  
                       </div>  
                       <div class="row">  
                           @foreach ($notifications as $notification)  
                               <div class="col-12 mb-3 stretch-card">  
                                   <div class="card">  
                                       <div class="card-body">  
                                           <div class="notification-card">  
                                               <i class="fas fa-bell notification-icon"></i>  
                                               <div>  
                                                   <div class="notification-title">{{ $notification->jenis }}</div>  
                                                   <div class="notification-time">{{ $notification->updated_at->diffForHumans() }}</div>  
                                                   <p>{{ $notification->isi_pesan }}</p>  
                                               </div>  
                                           </div>  
                                       </div>  
                                   </div>  
                               </div>  
                           @endforeach  
                       </div>  
                   </div>  
               </div>  
           </div>  
           <!-- footer -->  
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
       @include('layouts.mitra.script')  
   </body>  
   </html>  
