@extends('layouts.main')

@section('content')

    <link rel="stylesheet" href="css/ticker.css">
    {{-- INI HEADER     --}}
    <x-header :jobCount2="$jobCount"></x-header>
    @if (!$jobtitle && !$jobType && !$jobIndustry && !$jobLevel)
        <div class="px-4 py-8 mx-auto bg-white " id="company">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800">Company Partner</h2>
                <p class="text-lg text-gray-600">Explore top companies offering remote job opportunities</p>
            </div>
            {{-- Logo ticker --}}
            <div class="container px-4 py-8 mx-auto">
                <div class="logo-ticker">
                    <div class="logo-track">
                        @foreach ($uniqueLogos as $job)
                            <div class="flex-shrink-0 mx-2 my-2">
                                <img src="{{ $job['companyLogo'] }}" alt="{{ $job['companyName'] }}"
                                    class="object-contain w-16 h-16 transition-transform rounded-lg shadow-md hover:scale-110 sm:w-14 sm:h-14 md:w-20 md:h-20 lg:w-24 lg:h-24">
                            </div>
                        @endforeach
                    </div>
                    <div class="logo-track">
                        @foreach ($uniqueLogos as $job)
                            <div class="flex-shrink-0 mx-2 my-2">
                                <img src="{{ $job['companyLogo'] }}" alt="{{ $job['companyName'] }}"
                                    class="object-contain w-16 h-16 transition-transform rounded-lg shadow-md hover:scale-110 sm:w-14 sm:h-14 md:w-20 md:h-20 lg:w-24 lg:h-24">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Job Filter --}}
    <div class="flex justify-center py-8 bg-white " id="filter">
        <form method="GET" action="{{ route('index') }}#filter"
            class="w-full max-w-4xl p-6 space-y-4 bg-white rounded-lg drop-shadow sm:space-y-0 sm:space-x-4 sm:flex sm:items-center">

            <!-- Job Title Search -->
            <div class="relative flex items-center w-full sm:w-auto">
                <svg class="absolute w-5 h-5 text-gray-400 left-3" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" name="jobtitle" placeholder="Search job title..." value="{{ $jobtitle ?? '' }}"
                    class="w-full py-2 pl-10 pr-4 text-sm text-gray-700 transition duration-200 border border-gray-300 rounded-lg bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white" />
            </div>

            <!-- Job Type Filter -->
            <div class="relative flex items-center w-full sm:w-auto">
                <select name="job_type"
                    class="w-full py-2 pl-4 pr-10 text-sm text-gray-700 transition duration-200 border border-gray-300 rounded-lg appearance-none bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                    <option value="">Job Type</option>
                    <option value="full-time" {{ strtolower($jobType) == 'full-time' ? 'selected' : '' }}>Full-time
                    </option>
                    <option value="part-time" {{ strtolower($jobType) == 'part-time' ? 'selected' : '' }}>Part-time
                    </option>
                    <option value="contract" {{ strtolower($jobType) == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ strtolower($jobType) == 'internship' ? 'selected' : '' }}>Internship
                    </option>
                </select>
                <svg class="absolute w-5 h-5 text-gray-400 pointer-events-none right-3" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </div>

            <!-- Job Industry Filter -->
            <div class="relative flex items-center w-full sm:w-auto">
                <select name="job_industry"
                    class="w-full py-2 pl-4 pr-10 text-sm text-gray-700 transition duration-200 border border-gray-300 rounded-lg appearance-none bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                    <option value="">Industry</option>

                    <!-- Technology Group -->
                    <optgroup label="Technology">
                        <option value="Software Engineering"
                            {{ strtolower($jobIndustry) == 'software engineering' ? 'selected' : '' }}>Software Engineering
                        </option>
                        <option value="DevOps &amp; SysAdmin"
                            {{ strtolower($jobIndustry) == 'devops & sysadmin' ? 'selected' : '' }}>DevOps &amp; SysAdmin
                        </option>
                        <option value="Programming" {{ strtolower($jobIndustry) == 'programming' ? 'selected' : '' }}>
                            Programming</option>
                        <option value="Data Science" {{ strtolower($jobIndustry) == 'data science' ? 'selected' : '' }}>
                            Data Science</option>
                        <option value="Technical Support"
                            {{ strtolower($jobIndustry) == 'technical support' ? 'selected' : '' }}>Technical Support
                        </option>
                    </optgroup>

                    <!-- Finance Group -->
                    <optgroup label="Finance">
                        <option value="Finance &amp; Legal"
                            {{ strtolower($jobIndustry) == 'finance & legal' ? 'selected' : '' }}>Finance &amp; Legal
                        </option>
                    </optgroup>

                    <!-- Marketing Group -->
                    <optgroup label="Marketing">
                        <option value="Social Media Marketing"
                            {{ strtolower($jobIndustry) == 'social media marketing' ? 'selected' : '' }}>Social Media
                            Marketing</option>
                        <option value="Copywriting &amp; Content"
                            {{ strtolower($jobIndustry) == 'copywriting & content' ? 'selected' : '' }}>Copywriting &amp;
                            Content</option>
                        <option value="Marketing &amp; Sales"
                            {{ strtolower($jobIndustry) == 'marketing & sales' ? 'selected' : '' }}>Marketing &amp; Sales
                        </option>
                    </optgroup>

                    <!-- Sales Group -->
                    <optgroup label="Sales">
                        <option value="Sales" {{ strtolower($jobIndustry) == 'sales' ? 'selected' : '' }}>Sales</option>
                    </optgroup>

                    <!-- Design Group -->
                    <optgroup label="Design">
                        <option value="Design &amp; Creative"
                            {{ strtolower($jobIndustry) == 'design & creative' ? 'selected' : '' }}>Design &amp; Creative
                        </option>
                        <option value="Web &amp; App Design"
                            {{ strtolower($jobIndustry) == 'web & app design' ? 'selected' : '' }}>Web &amp; App Design
                        </option>
                    </optgroup>
                </select>
                <svg class="absolute w-5 h-5 text-gray-400 pointer-events-none right-3" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </div>

            <!-- Job Level Filter -->
            <div class="relative flex items-center w-full sm:w-auto">
                <select name="job_level"
                    class="w-full py-2 pl-4 pr-10 text-sm text-gray-700 transition duration-200 border border-gray-300 rounded-lg appearance-none bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                    <option value="">Level</option>
                    <option value="any" {{ strtolower($jobLevel) == 'any' ? 'selected' : '' }}>Any</option>
                    <option value="senior" {{ strtolower($jobLevel) == 'senior' ? 'selected' : '' }}>Senior</option>
                    <option value="director" {{ strtolower($jobLevel) == 'director' ? 'selected' : '' }}>Director</option>
                    <option value="Junior, Midweight, Senior"
                        {{ strtolower($jobLevel) == 'junior-midweight' ? 'selected' : '' }}>Junior - Midweight</option>
                </select>
                <svg class="absolute w-5 h-5 text-gray-400 pointer-events-none right-3" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </div>
            <!-- Filter Button -->
            <button type="submit"
                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition duration-200 bg-blue-500 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mr-2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                </svg>
                Filter
            </button>
        </form>
    </div>

    {{-- Job List --}}
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




    <!-- Call to Action Section -->
    @guest
        <section class="py-12 text-white bg-gradient-to-r from-blue-600 to-blue-700">
            <div class="container px-6 mx-auto text-center">
                <!-- Judul -->
                <h2 class="mb-4 text-3xl font-bold leading-snug md:text-4xl animate-fade-in">
                    Take the First Step Towards Your Dream Career
                </h2>

                <!-- Subjudul -->
                <p class="mb-6 text-base font-light delay-200 md:text-lg opacity-90 animate-fade-in">
                    Thousands of opportunities are waiting for you. Don’t miss out!
                </p>

                <!-- Tombol CTA -->
                <div class="flex justify-center gap-3">
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-base font-medium text-indigo-700 transition duration-300 bg-white rounded-full shadow-lg hover:bg-gray-100 hover:shadow-xl hover:-translate-y-1">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 text-base font-medium transition duration-300 bg-yellow-400 rounded-full shadow-lg text-indigo-50 hover:bg-yellow-300 hover:shadow-xl hover:-translate-y-1">
                        Register
                    </a>
                </div>
            </div>
        </section>
    @endguest


    {{-- Chatbot --}}
    <x-chatbot></x-chatbot>
@endsection
