<a href='/posts/category' class="round-button" {{ $attributes->merge(['class' => 'round-button']) }}>
    <img src="{{ asset('/img/20230512_185647.jpg') }}" style="width: 20px;">
</a>

<style>
.round-button {
    border-radius: 50%;
    background-color: #9DC3C0;
    width: 50px;
    height: 50px;
    cursor: pointer;
    display: flex; /* Center the image */
    align-items: center; /* Center the image vertically */
    justify-content: center; /* Center the image horizontally */
    text-decoration: none; /* Remove underline from link */
}

.round-button img {
    width: 16px; /* Adjust the size of the image */
    height: 16px;
}
</style>