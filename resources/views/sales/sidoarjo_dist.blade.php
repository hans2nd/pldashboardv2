<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumbs>{{ $breadcrumbs }}</x-slot:breadcrumbs>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <x-dashboard-iframe :title="$title" :breadcrumbs="$breadcrumbs" :menu="$menu" :iframe="$iframe" />
</x-layout>
