<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Join as a Donor</h2>

        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">1. Account Info</h3>

            <div>
                <x-input-label for="name" :value="__('Full Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="017xxxxxxxx" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">2. Donor Details</h3>

            <div>
                <x-input-label for="blood_group" :value="__('Blood Group')" />
                <select id="blood_group" name="blood_group" class="block mt-1 w-full border-gray-300 focus:border-[#E63946] focus:ring-[#E63946] rounded-md shadow-sm" required>
                    <option value="">Select Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <x-input-error :messages="$errors->get('blood_group')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

                <div>
                    <x-input-label for="division" :value="__('Division')" />
                    <select id="division" name="division" class="block mt-1 w-full border-gray-300 focus:border-[#E63946] focus:ring-[#E63946] rounded-md shadow-sm" required>
                        <option value="">Select Division</option>
                    </select>
                    <x-input-error :messages="$errors->get('division')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="district" :value="__('District')" />
                    <select id="district" name="district" class="block mt-1 w-full border-gray-300 focus:border-[#E63946] focus:ring-[#E63946] rounded-md shadow-sm disabled:bg-gray-100" disabled required>
                        <option value="">Select District</option>
                    </select>
                    <x-input-error :messages="$errors->get('district')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="upazila" :value="__('Area / Upazila')" />
                    <select id="upazila" name="upazila" class="block mt-1 w-full border-gray-300 focus:border-[#E63946] focus:ring-[#E63946] rounded-md shadow-sm disabled:bg-gray-100" disabled required>
                        <option value="">Select Area</option>
                    </select>
                    <x-input-error :messages="$errors->get('upazila')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-[#E63946] hover:bg-red-700">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division');
            const districtSelect = document.getElementById('district');
            const upazilaSelect = document.getElementById('upazila');

            // JSON ডাটা লোড করা
            fetch('/data/bd-locations.json')
                .then(res => res.json())
                .then(data => {
                    const divisions = data.divisions || data;

                    // বিভাগ অপশন যোগ করা
                    Object.keys(divisions).sort().forEach(div => {
                        const option = document.createElement('option');
                        option.value = div;
                        option.text = div;
                        divisionSelect.appendChild(option);
                    });

                    // বিভাগ পাল্টালে জেলা লোড
                    divisionSelect.addEventListener('change', function() {
                        const selectedDiv = this.value;
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        upazilaSelect.innerHTML = '<option value="">Select Area</option>';
                        districtSelect.disabled = true;
                        upazilaSelect.disabled = true;

                        if (selectedDiv && divisions[selectedDiv]) {
                            districtSelect.disabled = false;
                            Object.keys(divisions[selectedDiv]).sort().forEach(dist => {
                                const option = document.createElement('option');
                                option.value = dist;
                                option.text = dist;
                                districtSelect.appendChild(option);
                            });
                        }
                    });

                    // জেলা পাল্টালে উপজেলা লোড
                    districtSelect.addEventListener('change', function() {
                        const selectedDiv = divisionSelect.value;
                        const selectedDist = this.value;
                        upazilaSelect.innerHTML = '<option value="">Select Area</option>';
                        upazilaSelect.disabled = true;

                        if (selectedDist && divisions[selectedDiv][selectedDist]) {
                            upazilaSelect.disabled = false;
                            divisions[selectedDiv][selectedDist].sort().forEach(upa => {
                                const option = document.createElement('option');
                                option.value = upa;
                                option.text = upa;
                                upazilaSelect.appendChild(option);
                            });
                        }
                    });
                })
                .catch(error => console.error('Error loading location data:', error));
        });
    </script>
</x-guest-layout>