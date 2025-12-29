<div class="flex w-full h-[20%] justify-end">
    <div class="flex bg-red-600 w-full h-full">
        <div class="flex flex-col py-6 px-36 text-white items-center">

            {{-- table --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- left footer section --}}
                <div id="footer-left-section">
                    <div class="flex flex-col gap-4">

                        {{-- image logo --}}
                        <div class="flex w-full justify-center">
                            <img src="{{ asset('images/logo/application-logo.png') }}" alt="website logo" class="w-24">
                        </div>

                        {{-- about us --}}
                        <div>
                            <p class="font-semibold text-lg">About us</p>
                            <p class="text-sm text-justify">
                                Tel-U Reporting Website merupakan platform pelaporan terpadu <br class="hidden">
                                bagi sivitas akademika Telkom Universitas untuk menyampaikan <br class="hidden">
                                laporan terkait kerusakan fasilitas kampus serta kehilangan <br class="hidden">
                                dan penemuan barang.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- middle footer section --}}
                <div id="footer-middle-section">
                    <div class="flex flex-col lg:items-center">
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold text-lg">Our Services</p>
                        <div class="flex flex-col gap-1 text-sm text-justify">
                            <p><i class="fas fa-box-open mr-2"></i>Lost and Found</p>
                            <p><i class="fas fa-flag mr-3"></i>Reporting Facilities</p>
                            <p><i class="fas fa-comments mr-2"></i>Student Aspiration</p>
                        </div>
                    </div>
                    </div>
                </div>

                {{-- right footer section --}}
                <div id="footer-right-section">
                    <div class="flex flex-col gap-1">
                        
                        {{-- social media --}}
                        <p class="font-semibold text-lg">Our Social Media</p>
                        <div class="flex flex-col gap-1 text-sm text-justify">
                            <p><i class="fab fa-instagram mr-2"></i>@Tel-UReportWeb.Official</p>
                            <p><i class="fab fa-facebook mr-2"></i>Tel-UReportWeb.Official</p>
                            <p><i class="fab fa-twitter mr-2"></i>@Tel-UReportWeb.Official</p>
                        </div>

                        {{-- contact us --}}
                        <p class="font-semibold text-lg mt-4">Contact Us</p>
                        <div class="flex flex-col gap-1 text-sm text-justify">
                            <p><i class="fab fa-whatsapp mr-2"></i>+62 857-3453-3536</p>
                            <p><i class="fas fa-envelope-open mr-2"></i>cstelureportingwebsite@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-3"><i class="far fa-copyright mr-2"></i>Tel-U Reporting Website</p>
        </div>
    </div>
</div>
