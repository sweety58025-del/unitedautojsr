@php
    use App\Models\Category;
    $services = Category::where('status','yes')->get();
@endphp

<section class="wptb-service-one z-index-2 bg-image-2 position-relative" style="background-image: url('{{ asset('front/assets/img/background/bg-1.png') }}');">
    <div class="wptb-item-layer wptb-item-layer-four slide-top-to-bottom">
        <img src="{{ asset('front/assets/img/more/object4.png') }}" alt="img">
    </div>
    <div class="container">
        <div class="wptb-heading">
            <div class="wptb-item--inner">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7">
                        <h6 class="wptb-item--subtitle">
                            Our Service List
                        </h6>
                        <h1 class="wptb-item--title"> Providing All Types of <br>
                            Car <span>Maintenance</span> Services</h1>
                        <div class="wptb-item--divider"></div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        {{-- <div class="wptb-item--button text-md-end">
                            <a class="btn-two" href="services-1.html">
                                <span class="btn-wrap">
                                    <span class="text-first">All Services</span>
                                    <span class="text-second"> <i class="bi bi-plus"></i> </span>
                                </span>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 col-sm-6">
                <div class="wptb-image-box1 wow fadeInLeft">
                    <div class="wptb-item--inner">
                        <div class="wptb-item--holder">
                            <h3 class="wptb-item--title"><a href="{{ route('service.details', $service->slug) }}">{{ $service->name }}</a></h3>
                            <p class="wptb-item--description">{{ Str::limit($service->description,90) }} </p>
                            
                            <div class="wptb-item--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="79" height="79" viewBox="0 0 79 79" fill="none">
                                    <g clip-path="url(#clip0_1_48522)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M39.1641 0.163086C60.7032 0.163086 78.1641 17.624 78.1641 39.1631C78.1641 60.7022 60.7032 78.1631 39.1641 78.1631C17.6249 78.1631 0.164062 60.7022 0.164062 39.1631C0.164062 17.624 17.6249 0.163086 39.1641 0.163086ZM54.6553 38.5149C53.3826 38.5149 52.3517 39.5467 52.3517 40.8198C52.3517 42.0925 53.3826 43.1244 54.6553 43.1244C55.928 43.1244 56.9635 42.0925 56.9635 40.8198C56.9635 39.5467 55.928 38.5149 54.6553 38.5149ZM23.6728 38.5149C22.4002 38.5149 21.3647 39.5467 21.3647 40.8198C21.3647 42.0925 22.4002 43.1244 23.6728 43.1244C24.9455 43.1244 25.9764 42.0925 25.9764 40.8198C25.9764 39.5467 24.9455 38.5149 23.6728 38.5149ZM21.4923 31.511H56.8356L53.2137 22.0275C52.94 21.3067 52.4883 20.7243 51.9318 20.3279C51.389 19.9419 50.7321 19.7262 50.0251 19.7262H28.3029C27.5958 19.7262 26.9389 19.9419 26.3961 20.3279C25.8396 20.7243 25.3881 21.3067 25.1143 22.0275L21.4923 31.511ZM58.4322 26.8577L59.6092 29.9323H60.5443C60.599 29.9323 60.6584 29.9072 60.6948 29.8666C60.7359 29.8255 60.7632 29.7708 60.7632 29.712V27.0786C60.7632 27.0192 60.7358 26.9645 60.6948 26.924C60.6582 26.8834 60.599 26.8578 60.5443 26.8578H58.4322V26.8577ZM18.7189 29.9323L19.8958 26.8577H17.7838C17.7246 26.8577 17.6697 26.8833 17.6287 26.9238C17.5922 26.9645 17.5649 27.0192 17.5649 27.0784V29.7118C17.5649 29.7707 17.5923 29.8253 17.6287 29.8665C17.6743 29.907 17.7246 29.9321 17.7838 29.9321H18.7189V29.9323ZM39.1641 39.686C33.0697 39.686 28.1295 44.6262 28.1295 50.7219C28.1295 52.2624 28.4442 53.7289 29.0145 55.0608L31.7559 52.3174C31.5962 51.5502 31.5597 50.7624 31.6464 49.9859C32.0068 46.7699 34.543 44.1018 37.7407 43.5828C39.5699 43.2854 41.4858 43.7017 43.0185 44.7422L37.6723 47.8304V51.529L40.8746 53.3779L46.2208 50.2897C46.3667 52.3314 45.6597 54.422 44.0951 55.9835C42.2796 57.7992 39.748 58.461 37.4124 57.9706L34.607 60.7751C35.9938 61.4064 37.5401 61.7577 39.1641 61.7577C45.2584 61.7577 50.1986 56.817 50.1986 50.7219C50.1986 44.6262 45.2584 39.686 39.1641 39.686ZM17.7838 48.9478V55.4176C17.7838 56.1834 18.4088 56.8083 19.175 56.8083H23.8005C24.5669 56.8083 25.1919 56.1834 25.1919 55.4176V53.2298C25.0459 52.416 24.9728 51.5776 24.9728 50.7219C24.9728 42.8836 31.327 36.5285 39.1639 36.5285C47.0008 36.5285 53.355 42.8836 53.355 50.7219C53.355 51.5776 53.2821 52.4161 53.1361 53.2302V55.4176C53.1361 56.1834 53.761 56.8083 54.5275 56.8083H59.1529C59.9192 56.8083 60.5443 56.1834 60.5443 55.4176V48.9478C61.9311 47.9789 62.8479 46.3688 62.8479 44.5523V38.6951C62.8479 37.15 62.5924 35.8291 62.013 34.3958L61.4382 32.9685C62.0085 32.8107 62.5193 32.5064 62.93 32.0991C63.5412 31.4874 63.9199 30.6425 63.9199 29.712V27.0786C63.9199 26.1475 63.5414 25.3032 62.93 24.6915C62.3188 24.0803 61.4702 23.7002 60.5443 23.7002H57.2281L56.1606 20.9049C55.6633 19.5944 54.8195 18.5173 53.7566 17.7623C52.6847 16.9965 51.3938 16.5685 50.0253 16.5685H28.3029C26.9298 16.5685 25.6434 16.9965 24.5715 17.7623C23.5086 18.5173 22.6648 19.5942 22.1675 20.9049L21.1001 23.7002H17.7838C16.8533 23.7002 16.0093 24.0797 15.3981 24.6915C14.7868 25.3033 14.4082 26.1476 14.4082 27.0786V29.712C14.4082 30.6425 14.7868 31.4874 15.3981 32.0991C15.8041 32.5064 16.3197 32.8107 16.8897 32.9685L16.3149 34.3958C15.7356 35.8291 15.4801 37.1502 15.4801 38.6951V44.5523C15.4802 46.3687 16.3971 47.9789 17.7838 48.9478Z" fill="#D70006"/>
                                    </g>
                                    <defs>
                                        <clipPath>
                                        <rect width="78" height="78" fill="white" transform="translate(0.164062 0.163086)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            
                            <div class="wptb-item--image">
                                <a href="{{ route('service.details', $service->slug) }}" class="wptb-item-link"><img src="{{ asset($service->category_image) }}" alt="img"></a>
                            </div>
                            
                            <div class="wptb-item--button">
                                <a class="btn-three black" href="{{ route('service.details', $service->slug) }}">
                                    <span class="btn-wrap">
                                        <span class="text-first">Get Services</span>
                                        <span class="text-second">Get Services</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            
        </div>
    </div>
</section>