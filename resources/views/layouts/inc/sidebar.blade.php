<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
    <img src="/adminlte/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity:.8">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
</a>
<div class="sidebar">
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- <x-nav-item href="{{ route('welcome') }}" :title="[
    'name'=>'Welcome',
    'icon'=>'fas fa-home',
    'active'=>['welcome']
    ]"/> --}}
    <x-nav-item href="{{ route('home') }}" :title="[
        'name'=>'Dashboard',
        'icon'=>'fas fa-home',
        'active'=>['home']
        ]"/>
@can('admin')
    <x-nav-item href="{{ route('user.index') }}" :title="[
        'name' => 'Users',
        'icon' => 'fas fa-users',
        'active' => ['user.index', 'user.edit', 'user.create']
    ]"/>
@endcan
@can('manajer')
    <x-nav-item href="{{ route('menu.index') }}" :title="[
        'name' => 'Menu',
        'icon' => 'fas fa-utensils',
        'active' => ['menu.index', 'menu.edit', 'menu.create']
    ]"/>
@endcan
@can('kasir')
  <x-nav-item href="{{ route('cart.index') }}" :title="[
    'name' => 'Cart',
    'icon' => 'fas fa-shopping-cart',
    'active' => ['cart.index']
  ]" />
@endcan
@can('role', ['kasir', 'manajer'])
    <x-nav-item href="{{ route('transaksi.index') }}" :title="[
        'name' => 'Transaksi',
        'icon' => 'fas fa-cash-register',
        'active' => ['transaksi.index', 'transaksi.show']
    ]"/>
@endcan
@can('manajer')
    <x-nav-item href="{{ route('laporan.index') }}" :title="[
        'name' => 'Laporan',
        'icon' => 'fas fa-clipboard',
        'active' => ['laporan.index']
    ]"/>
@endcan
 {{-- <x-nav-item href="{{ route('form') }}" :title="[
    'name'=>'Forms',
    'icon'=>'fas fa-edit',
    'active'=>['form']
    ]"/> --}}

{{-- <x-nav-item href="{{ route('list') }}" :title="[
    'name'=>'Table List',
    'icon'=>'fas fa-list',
    'active'=>['list']
    ]"/> --}}

@can('role', ['admin','manajer'])
<x-nav-item href="{{ route('log') }}" :title="[
    'name'=>'Log Activity',
    'icon'=>'fas fa-shoe-prints',
    'active'=>['log']
    ]"/>
@endcan



</nav>
</div>
</aside>
