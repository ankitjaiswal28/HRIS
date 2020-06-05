@extends('Layout.app')
@section('content')
<style>
    .card {
        position: relative;
    }

    .card .front,
    .card .back {
        position: absolute;
        left: 0;
        top: 0;
    }

    .card .mdl-card {
        width: 100%;
        height: 320px;
    }

    .card .avatar {
        position: absolute;
        right: 30px;
        top: 30px;
        border-radius: 50%;
    }

    .card .front .mdl-card__title,
    .card .back .mdl-card__title {
        color: #fff;
    }

    .card .front .mdl-card__title {
        background-color: rgb(244, 67, 54);
    }

    .card .back .mdl-card__title {
        background-color: rgb(63, 81, 181);
    }

    .card .mdl-button {
        transition: none !important;
    }

    /*default*/

    body {
        overflow-x: hidden;
    }

    .header-white {
        background-color: #fff;
        color: #000;
    }

    .header-white small {
        color: #999;
    }

    .header-white .mdl-navigation__link {
        color: #424242;
    }

    .container {
        width: 1200px;
        margin: 0 auto;
    }

    .container .mdl-cell-custom {
        height: 320px;
        position: relative;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading {
        animation-duration: 0.75s;
        animation-iteration-count: infinite;
        animation-name: rotate;
        animation-timing-function: linear;
        height: 20px;
        width: 20px;
        border: 4px solid rgb(63, 81, 181);
        border-right-color: transparent;
        border-radius: 50%;
        display: inline-block;
        position: absolute;
        left: calc(50% - 20px);
        top: calc(50% - 20px);
    }

    .header-white .mdl-navigation__link.fork-me {
        background-color: #673ab7;
        color: #fff;
    }

    .header-white .mdl-navigation__link.more-details {
        background-color: #CDDC39;
        color: #333;
    }
</style>
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.red-indigo.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/thiagoh/de-animate/0.2.3/dist/jquery.de-animate.min.js"></script>
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <main class="mdl-layout__content">
        <div class="page-content">
            <div class="mdl-grid container-fluid">
                <div class="mdl-cell mdl-cell-custom mdl-cell--4-col">

                    <div id="card-2" class="card animated">

                        <div class="back demo-card-square mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title mdl-card--expand">
                                <img class="avatar" src="http://api.adorable.io/avatars/136/FlipInY.png" alt="" />
                                <h2 class="mdl-card__title-text">Back FlipInY</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                Back of Panel content Flipped Y
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <div class="mdl-button mdl-button--colored">
                                    toggle card
                                </div>
                            </div>
                        </div>

                        <div class="front demo-card-square mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title mdl-card--expand">
                                <img class="avatar" src="http://api.adorable.io/avatars/136/FlipOutY.png" alt="" />
                                <h2 class="mdl-card__title-text">Front FlipInY</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                Front of Panel content Flipped Y
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <div class="mdl-button mdl-button--colored">
                                    toggle card
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>

</div>
<script>
  $('#card-2').deAnimate({
    trigger: 'click',
    classIn: 'flipInY',
    parallel: false
  });
</script>
@endsection
