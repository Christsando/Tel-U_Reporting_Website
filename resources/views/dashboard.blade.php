<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-2">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen lg:min-h-[500px]">
        <div class="mx-auto">
            <x-carousel-dashboard :carousels="$carousels"/>

            <div class="p-6">
                <div class="p-12 flex flex-col min-h-[250px] gap-8">
                    <div class="flex flex-row">
                        <div class="w-[40%]">
                            <img src="{{ asset("images/news/carousel1.jpg") }}" alt="Berita Telkom 1" >
                        </div>
                        <div class="ml-8 max-w-[60%]">
                            <h2 class="font-semibold text-xl">Telkom University - Gedung TULT</h2>
                            <p class="text-gray-500 text-justify">
                                Bandung – Telkom University terus menunjukkan komitmennya dalam meningkatkan kualitaspendidikan tinggi di Indonesia melalui berbagai inovasi di bidang akademik, riset, dan pengabdian kepada masyarakat. Sebagai perguruan tinggi berbasis teknologi dan kewirausahaan, Telkom University aktif mendorong mahasiswa untuk berprestasi di tingkat nasional maupun internasional serta beradaptasi dengan perkembangan industri digital.
                                <br/><br/>
                                Selain fokus pada pengembangan akademik, Telkom University juga aktif menjalin kerja sama strategis dengan berbagai institusi nasional maupun internasional, baik di bidang pendidikan, penelitian, maupun industri. Kolaborasi ini bertujuan untuk memperkuat relevansi kurikulum dengan kebutuhan dunia kerja serta meningkatkan kompetensi lulusan agar mampu bersaing di era global.
                                <br/><br/>
                                Dalam upaya menciptakan lingkungan belajar yang inovatif dan inklusif, Telkom University terus mengembangkan fasilitas pendukung pembelajaran berbasis digital, laboratorium modern, serta ekosistem riset yang mendorong lahirnya karya-karya unggulan dari sivitas akademika. Berbagai program pengembangan karakter dan kepemimpinan mahasiswa juga menjadi bagian penting dalam membentuk lulusan yang tidak hanya unggul secara akademis, tetapi juga memiliki integritas dan kepedulian sosial.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-row">
                        <div class="w-[40%]">
                            <img src="{{ asset("images/news/carousel2.jpg") }}" alt="Berita Telkom 1" >
                        </div>
                        <div class="ml-8 max-w-[60%]">
                            <h2 class="font-semibold text-xl">Telkom University</h2>
                            <p class="text-gray-500 text-justify">
                                Bandung – Telkom University terus menunjukkan komitmennya dalam meningkatkan kualitaspendidikan tinggi di Indonesia melalui berbagai inovasi di bidang akademik, riset, dan pengabdian kepada masyarakat. Sebagai perguruan tinggi berbasis teknologi dan kewirausahaan, Telkom University aktif mendorong mahasiswa untuk berprestasi di tingkat nasional maupun internasional serta beradaptasi dengan perkembangan industri digital.
                                <br/><br/>
                                Selain fokus pada pengembangan akademik, Telkom University juga aktif menjalin kerja sama strategis dengan berbagai institusi nasional maupun internasional, baik di bidang pendidikan, penelitian, maupun industri. Kolaborasi ini bertujuan untuk memperkuat relevansi kurikulum dengan kebutuhan dunia kerja serta meningkatkan kompetensi lulusan agar mampu bersaing di era global.
                                <br/><br/>
                                Dalam upaya menciptakan lingkungan belajar yang inovatif dan inklusif, Telkom University terus mengembangkan fasilitas pendukung pembelajaran berbasis digital, laboratorium modern, serta ekosistem riset yang mendorong lahirnya karya-karya unggulan dari sivitas akademika. Berbagai program pengembangan karakter dan kepemimpinan mahasiswa juga menjadi bagian penting dalam membentuk lulusan yang tidak hanya unggul secara akademis, tetapi juga memiliki integritas dan kepedulian sosial.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
