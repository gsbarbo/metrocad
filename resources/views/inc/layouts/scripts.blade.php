@livewireScripts

<script>
    function defaultImage(type) {
        switch (type) {
            case "logo":
                event.target.src =
                    "https://docs.imperialcad.app/~gitbook/image?url=https%3A%2F%2F1656672024-files.gitbook.io%2F%7E%2Ffiles%2Fv0%2Fb%2Fgitbook-x-prod.appspot.com%2Fo%2Forganizations%252FfqpjeLpCxwQcW28l1QXH%252Fsites%252Fsite_Zna1u%252Ficon%252FX0J2FHsuOCxUrgQnoIKu%252F432342432.png%3Falt%3Dmedia%26token%3Da2fcfda0-d8b2-4f99-a40f-9a7dc563a471&width=32&dpr=1&quality=100&sign=475e4836&sv=2";
                break;

            case "user":
                event.target.src =
                    "https://docs.imperialcad.app/~gitbook/image?url=https%3A%2F%2F1656672024-files.gitbook.io%2F%7E%2Ffiles%2Fv0%2Fb%2Fgitbook-x-prod.appspot.com%2Fo%2Forganizations%252FfqpjeLpCxwQcW28l1QXH%252Fsites%252Fsite_Zna1u%252Ficon%252FX0J2FHsuOCxUrgQnoIKu%252F432342432.png%3Falt%3Dmedia%26token%3Da2fcfda0-d8b2-4f99-a40f-9a7dc563a471&width=32&dpr=1&quality=100&sign=475e4836&sv=2";
                break;

            case "civilian":
                event.target.src =
                    "https://docs.imperialcad.app/~gitbook/image?url=https%3A%2F%2F1656672024-files.gitbook.io%2F%7E%2Ffiles%2Fv0%2Fb%2Fgitbook-x-prod.appspot.com%2Fo%2Forganizations%252FfqpjeLpCxwQcW28l1QXH%252Fsites%252Fsite_Zna1u%252Ficon%252FX0J2FHsuOCxUrgQnoIKu%252F432342432.png%3Falt%3Dmedia%26token%3Da2fcfda0-d8b2-4f99-a40f-9a7dc563a471&width=32&dpr=1&quality=100&sign=475e4836&sv=2";
                break;

            default:
                console.log("messed up default image.");
                break;
        }
    }

    function openExternalWindow(url, height = 800, width = 900) {
        return window.open(
            url,
            "_blank",
            "height=" + height + ",width=" + width + ",scrollbars=no,status=yes",
            true
        );
    }
</script>
