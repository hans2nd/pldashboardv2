<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Selamat Datang di Dashboard Pangan Lestari</h1>
                    <br>
                    <hr>
                    Hallo, {{ Auth::user()->name }}
                    <br>
                    <br>

                </div>
            </div>
        </div>
    </div>
</x-layout>
