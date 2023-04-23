@props(['class'])

<button class="{{ $class }}" type="button" onclick="scrollToTop()">
    <x-atoms.arrow-top />
</button>

<script>
    function scrollToTop() {
        window.scrollTo({
            top: 250,
            behavior: 'smooth'
        });
    }
</script>
