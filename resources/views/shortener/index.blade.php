<div class="relative overflow-x-auto shadow-md sm:rounded-lg" x-data="{ createShortUrl: false }">
    <div class="pb-4 bg-white dark:bg-gray-900">
        <div class="grid w-full grid-cols-2 mt-4 mb-4">
            <div class="inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none gap-2">
                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                </svg>
                <h4 class="text-white">All Url List</h4>
            </div>
            <div class="flex justify-end">
                <x-secondary-button class="flex gap-2" @click="createShortUrl = true">
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3"/>
                    </svg>
                    Short Url
                </x-secondary-button>
            </div>
        </div>
    </div>

    <span><x-input-error class="mt-2" :messages="$errors->get('url')"/></span>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Url name
            </th>
            <th scope="col" class="px-6 py-3">
                Short url
            </th>
            <th scope="col" class="px-6 py-3">
                Long Url
            </th>
            <th scope="col" class="px-6 py-3">
                Clicks
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @if($shortenedUrls->isNotEmpty())
            @php $appUrl = env('APP_URL') @endphp
            @foreach($shortenedUrls as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">
                        <a href="{{ route('redirected.to.original.url') }}">{{ $appUrl.'/'.$item->shorten_url }}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->original_url }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->click_count }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>

            @endforeach

        @else
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <p>no urls yet</p>
            </tr>
        @endif

        </tbody>
    </table>

    <div x-show="createShortUrl"
         class="fixed inset-0 z-40 flex items-center justify-center bg-background/80 backdrop-blur-sm transition-opacity duration-300 ease-out">
        <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" @click="createShortUrl = false"></div>
        <div
            class="relative z-50 w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 transition-all duration-300 ease-out">
            <div class="grid grid-cols-2 space-y-1.5 text-center sm:text-left">
                <h3 class="text-xl text-white font-semibold leading-none tracking-tight mb-4">Convert to Short Url</h3>
                <button @click="createShortUrl = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form class="mt-6 space-y-6" method="post" action="{{ route('url.shortener') }}">
                @csrf
                <div>
                    <x-input-label class="text-white" for="name" :value="__('Name')"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                                  autocomplete="name"/>
                    <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                </div>

                <div>
                    <x-input-label class="text-white" for="url" :value="__('Url')"/>
                    <x-text-area id="url" name="url" type="text" class="mt-1 block w-full" required autofocus
                                 autocomplete="url"/>
                    <x-input-error class="mt-2" :messages="$errors->get('url')"/>
                </div>

                <div class="mt-4 flex gap-2 justify-end">
                    <x-secondary-button type="button" @click="createShortUrl = false">
                        Close
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Submit
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</div>
