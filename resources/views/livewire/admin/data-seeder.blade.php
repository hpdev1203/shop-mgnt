<div>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl">
                <form wire:submit='seedData'>
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Data Seeder</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Create random data for testing</p>
                            <div class="mt-10 space-y-10">
                                <div class="mt-6 space-y-6">
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model='cbx_customer' id="cbx_customer" name="cbx_customer" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="cbx_customer" class="font-medium text-gray-900">Customer</label>
                                        </div>
                                    </div>
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model='cbx_brand' id="cbx_brand" name="cbx_brand" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="cbx_brand" class="font-medium text-gray-900">Brand</label>
                                        </div>
                                    </div>
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model='cbx_category' id="cbx_category" name="cbx_category" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="cbx_category" class="font-medium text-gray-900">Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <span wire:loading.remove>Seed Data</span>
                            <span wire:loading>Seeding Data...</span>
                        </button>
                    </div>

                    @if(session()->has('message'))
                        <div class="mt-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="mt-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Error</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>