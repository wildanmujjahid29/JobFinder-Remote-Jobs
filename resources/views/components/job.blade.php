
@props(['jobs'])
<div>
    {{-- Job List --}}
    <div class="px-8 py-8 mx-auto bg-white ">
        @if (count($jobs) > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($jobs as $job)
                    <!-- Job List Item -->
                    <div
                        class="flex flex-col gap-1 px-8 py-8 transition-all duration-300 ease-in-out bg-white rounded-lg drop-shadow ">
                        <div class="flex items-center h-20 -mt-4 space-x-4">
                            <img src="{{ $job['companyLogo'] }}" alt="{{ $job['companyName'] }}"
                                class="w-12 h-12 rounded-full shadow-md">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-600">{{ $job['jobTitle'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $job['companyName'] }}</p>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-400 ">
                            <div class="flex gap-2">
                                <p
                                    class="bg-violet-50 rounded-lg text-violet-500 px-3 py-1 overflow-hidden text-ellipsis whitespace-nowrap w-[12ch]  ">
                                    {{ $job['jobGeo'] }}</p>
                                <p
                                    class="px-3 py-1 overflow-hidden text-green-500 rounded-lg bg-green-50 text-ellipsis whitespace-nowrap">
                                    {{ $job['jobIndustry'][0] }}</p>
                                <p
                                    class="px-3 py-1 overflow-hidden text-orange-500 rounded-lg bg-orange-50 text-ellipsis whitespace-nowrap">
                                    {{ $job['jobType'][0] }}</p>
                            </div>
                            <p>Posted: {{ \Carbon\Carbon::parse($job['pubDate'])->diffForHumans() }}</p>
                        </div>
                        <div class="mt-4">
                            @auth
                                <a href="{{ url('/job/' . $job['id']) }}"
                                    class="w-full px-4 py-2 font-semibold text-center text-blue-600 transition duration-300 border-2 border-blue-500 rounded-lg hover:bg-blue-500 hover:text-white">
                                    View Details
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full px-4 py-2 text-center text-white transition duration-300 bg-gray-600 rounded-lg hover:bg-gray-700">
                                    Login to View Details
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center p-8 text-center">
                @if ($jobtitle)
                    <svg class="w-20 h-20 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 12h.01M15 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="mb-2 text-2xl font-bold text-gray-700">No Jobs Found</h2>
                    <p class="text-gray-500">Sorry, no jobs match your search for "{{ $jobtitle }}".</p>
                    <a href="{{ route('index') }}"
                        class="px-6 py-3 mt-4 text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                        Reset Search
                    </a>
                @else
                    <h2 class="text-2xl font-bold text-gray-700">No Jobs Available</h2>
                    <p class="text-gray-500">There are currently no job listings.</p>
                @endif
            </div>
        @endif
    </div>
</div>