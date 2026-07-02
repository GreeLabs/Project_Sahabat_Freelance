{{-- Base dashboard CSS, followed by the shared neo-brutalism layer. --}}
<link rel="stylesheet" href="{{ asset('mitra/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('mitra/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('mitra/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('mitra/css/vertical-layout-light/style.css') }}">
@vite('resources/css/neo-brutalism.css')

<style>
    body { background-color: var(--nb-paper); }

    .dropdown-profile-header,
    .dropdown-subscription-info { padding: 14px; }

    .dropdown-profile-header {
        display: flex;
        align-items: center;
        gap: 12px;
    }
</style>
