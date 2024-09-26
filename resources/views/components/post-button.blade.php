<a href='/posts/category' class="round-button" {{ $attributes->merge(['class' => 'round-button']) }}>
    <img src="{{ asset('/img/plus.png') }}">
</a>

<style>
.round-button {
    border-radius: 50%;
    background-color: #9DC3C0;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0px 3px 6px rgba(157, 195, 192, .5);
}
.round-button img {
    width: 16px;
    height: 16px;
}
/*@media screen and (min-width: 990px) {*/
/*    .round-button {*/
/*        width: 64px;*/
/*        height: 64px;*/
/*    }*/
/*    .round-button img {*/
/*        width: 24px;*/
/*        height: 24px;*/
/*    }*/
/*}*/
</style>