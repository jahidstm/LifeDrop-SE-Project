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
                <select id="blood_group" name="blood_group" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="district" :value="__('District')" />
                    <select id="district" name="district" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="loadAreas()">
                        <option value="" disabled selected>Select District</option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chattogram">Chattogram</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Barishal">Barishal</option>
                        <option value="Rangpur">Rangpur</option>
                        <option value="Mymensingh">Mymensingh</option>
                        <option value="Comilla">Comilla</option>
                    </select>
                    <x-input-error :messages="$errors->get('district')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="upazila" :value="__('Upazila')" />
                    <select id="upazila" name="upazila" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="" disabled selected>Select District First</option>
                    </select>
                    <x-input-error :messages="$errors->get('upazila')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    // বাংলাদেশের সব জেলা ও তাদের উপজেলা/এরিয়া সম্পূর্ণ লিস্ট (Alphabetically Sorted)
    const locationData = {
        "Barishal": [
            "Aricha", "Babuganj", "Bakerganj", "Banaripara",
            "Bhola", "Chandpur", "Daulatkhan", "Gaurnadi",
            "Gournadi", "Hizla", "Jhalokati", "Mehendiganj",
            "Muladi", "Sadar", "Tazumuddin"
        ],
        "Chattogram": [
            "Anwara", "Bayazid", "Begumganj", "Boalkhali",
            "Banshkhali", "Double Mooring", "Fatikchari", "Hathazari",
            "Juraichhari", "Kotwali", "Lohagara", "Mirsharai",
            "Pahartali", "Panchlaish", "Patiya", "Rangunia",
            "Raozan", "Sandwip", "Satkania", "Sitakunda"
        ],
        "Comilla": [
            "Barura", "Brahmanpara", "Burichang", "Chandpur",
            "Chauddagram", "Debidwar", "Daudkandi", "Hajiganj",
            "Homna", "Laksham", "Monoharganj", "Muradnagar",
            "Noakhali", "Sadar", "Sandwip", "Senbag",
            "Sonagazi", "Sutrarkandi"
        ],
        "Dhaka": [
            "Banani", "Baridhara", "Dhanmondi", "Dohar",
            "Farmgate", "Gulshan", "Kakrail", "Kawran Bazar",
            "Keraniganj", "Khilkhet", "Mirpur", "Mohammadpur",
            "Motijheel", "Nawabganj", "Paltan", "Purana Paltan",
            "Rampura", "Savar", "Shahbag", "Uttara"
        ],
        "Khulna": [
            "Abhayanagar", "Assasuni", "Batiaghata", "Daulatpur",
            "Debhata", "Dighalia", "Dumuria", "Jessore",
            "Kaliganj", "Khan Jahan Ali", "Koira", "Paikgachha",
            "Phultala", "Rupsha", "Sadar", "Satkhira",
            "Sharankhola", "Sonadanga", "Khalishpur", "Terokhada"
        ],
        "Mymensingh": [
            "Bhaluka", "Dhobaura", "Gafargaon", "Haluaghat",
            "Jamalpur", "Madan", "Muktagachha", "Nandail",
            "Nalitabari", "Phulpur", "Sadar", "Sarispur",
            "Sherpur", "Tahirpur", "Trishal", "Valuka"
        ],
        "Rajshahi": [
            "Badalgachhi", "Bagmara", "Baraigram", "Boalia",
            "Charghat", "Durgapura", "Godagari", "Gurudaspur",
            "Mahadipur", "Mohanpur", "Motihar", "Naogaon",
            "Nator", "Patnitala", "Paba", "Rajpara",
            "Shah Makhdum", "Singra", "Tanore"
        ],
        "Rangpur": [
            "Badarganj", "Birganj", "Dinajpur", "Fulchari",
            "Gaibandha", "Gangachara", "Hakimpur", "Kaunia",
            "Khansama", "Mithapukur", "Nawabganj", "Panchagarh",
            "Pirgachha", "Pirganj", "Sadar", "Sadullapur",
            "Sundarganj", "Taraganj"
        ],
        "Sylhet": [
            "Beanibazar", "Bishwanath", "Chhatak", "Companiganj",
            "Dowarabazar", "Fenchuganj", "Golapganj", "Jaintiapur",
            "Kanaighat", "Moulvibazar", "Osmani Nagar", "Sadar",
            "Sreemangal", "Sunamganj", "Talifganj", "Zakiganj"
        ]
    };

    function loadAreas() {
        const districtSelect = document.getElementById("district");
        const areaSelect = document.getElementById("upazila");
        const selectedDistrict = districtSelect.value;

        // আগের অপশন ক্লিয়ার করা
        areaSelect.innerHTML = '<option value="" disabled selected>Select Area</option>';

        if (selectedDistrict && locationData[selectedDistrict]) {
            // ওই জেলার এরিয়াগুলো সর্ট করে অপশন বানানো
            const sortedAreas = locationData[selectedDistrict].sort();

            sortedAreas.forEach(function(area) {
                const option = document.createElement("option");
                option.value = area;
                option.text = area;
                areaSelect.appendChild(option);
            });
        } else {
            // যদি ডাটা না থাকে
            const option = document.createElement("option");
            option.text = "No area found";
            areaSelect.appendChild(option);
        }
    }
</script>