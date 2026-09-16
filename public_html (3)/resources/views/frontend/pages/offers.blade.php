@extends('frontend.partials.master')

@section('title', 'Offers')

@section('content')
@include('frontend.partials.breadcumbs')

<style>
    .offers-page {
        padding: 32px 0 120px;
    }

    .offers-page__intro {
        max-width: 760px;
        margin: 0 auto 42px;
        text-align: center;
    }

    .offers-page__intro p {
        max-width: 680px;
        margin: 18px auto 0;
        color: #666e85;
        font-size: 18px;
        line-height: 1.75;
    }

    .offers-page__grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 0 auto;
    }

    .offer-card {
        display: flex;
        height: 100%;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid #2f333b;
        background: #141518;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    .offer-card__image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #050505;
    }

    .offer-card__image::after {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.72));
        content: '';
    }

    .offer-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 58%;
    }

    .offer-card--poster .offer-card__image {
        height: 220px;
        background: #0757ad;
    }

    .offer-card--poster .offer-card__image::after {
        display: none;
    }

    .offer-card--poster .offer-card__image img {
        object-fit: contain;
        object-position: center;
    }

    .offer-card__number {
        position: absolute;
        z-index: 1;
        right: 24px;
        bottom: 18px;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .offer-card__body {
        flex: 1;
        padding: 30px 30px 32px;
        color: #fff;
    }

    .offer-card__eyebrow {
        margin-bottom: 10px;
        color: #ff3338;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .offer-card h2 {
        margin-bottom: 16px;
        color: #fff;
        font-size: 28px;
    }

    .offer-card p {
        margin-bottom: 0;
        color: rgba(255, 255, 255, 0.78);
        font-size: 18px;
        line-height: 1.7;
    }

    .offers-page__terms {
        max-width: 1080px;
        margin: 28px auto 0;
        color: #d70006;
        font-size: 17px;
        line-height: 1.6;
        text-align: center;
    }

    .offers-page__terms a {
        color: inherit;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    @media (max-width: 767px) {
        .offers-page {
            padding: 16px 0 80px;
        }

        .offers-page__intro p {
            font-size: 17px;
        }

        .offers-page__grid {
            grid-template-columns: 1fr;
        }

        .offer-card__image {
            height: 190px;
        }

        .offer-card--poster .offer-card__image {
            height: 190px;
        }

        .offer-card__body {
            padding: 26px 22px 28px;
        }

        .offer-card h2 {
            font-size: 25px;
        }

        .offer-card p {
            font-size: 17px;
        }
    }
</style>

<section class="offers-page">
    <div class="container">
        <div class="wptb-heading offers-page__intro">
            <div class="wptb-item--inner">
                <h6 class="wptb-item--subtitle">UNITED AUTO OFFERS</h6>
                <h1 class="wptb-item--title">Offers for your next visit</h1>
                <div class="wptb-item--divider mx-auto"></div>
                <p class="wptb-item--description">Explore the current service-card and roadside assistance offers available from United Auto.</p>
            </div>
        </div>

        <div class="offers-page__grid">
            <article class="offer-card offer-card--poster">
                <div class="offer-card__image">
                    <img src="{{ asset('images/offers.webp') }}" alt="United Auto VIP membership service offer" loading="lazy">
                </div>
                <div class="offer-card__body">
                    <p class="offer-card__eyebrow">Printed service card</p>
                    <h2>Service Card Offer</h2>
                    <p>We can introduce our printed card under offer. I have already shared you the card previously.</p>
                </div>
            </article>

            <article class="offer-card">
                <div class="offer-card__image">
                    <img src="{{ asset('front/assets/img/slider/car-2.png') }}" alt="Red car representing United Auto roadside assistance" loading="lazy">
                </div>
                <div class="offer-card__body">
                    <p class="offer-card__eyebrow">Roadside support</p>
                    <h2>25 km Road Assistance</h2>
                    <p>Road Assistance for break down to any customer within a range of 25 km from our workshop. <a href="{{ route('contact-us') }}" style="color: #fff; text-decoration: underline; text-underline-offset: 3px;">Workshop Location</a> in Google Maps with address to be delivered to customer who wants to avail the road side assistance.</p>
                </div>
            </article>
        </div>

        <p class="offers-page__terms">* <a href="{{ route('roadside-assistance') }}">Terms &amp; Conditions are applicable. (View details)</a></p>
    </div>
</section>
@endsection