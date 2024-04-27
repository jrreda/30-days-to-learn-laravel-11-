<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2 class="font-bold text-lg text-stone-950">{{ $job['title'] }}</h2>

    <p class="text-stone-950">
        This job pays {{ $job['salary'] }} per year.
    </p>

    <p class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </p>
</x-layout>