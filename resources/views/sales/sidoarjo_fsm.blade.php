<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        Dashboard {{ $breadcrumbs }}
                    </h2>
                </div>
                <div class="card-body">
                    <iframe title="LocalNew_PanganLestari_Sales1.11 SDA FSM" width="100%" height="800"
                        src="https://app.powerbi.com/view?r=eyJrIjoiOGJjZGZkMTItZjkwMy00OWYxLTliNjEtYmMwMmQwZjhlZDgxIiwidCI6ImEzNjFjYzRmLTRmYjktNGE2Zi1iMmMxLWE1ZjVkODU3OTEwYSIsImMiOjEwfQ%3D%3D"
                        frameborder="0" allowFullScreen="true"></iframe>
                </div>
            </div>
        </div>
    </div>
</x-layout>
