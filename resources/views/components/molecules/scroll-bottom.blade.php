@props(['class'])

<button class="{{ $class }}" type="button" onclick="scrollToBottom()">
    <x-atoms.arrow-bottom />
</button>

<script>
    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }
</script>
