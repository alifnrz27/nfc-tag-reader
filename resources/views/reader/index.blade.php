<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFC Tag Reader</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        input { padding: 10px; font-size: 18px; width: 80%; max-width: 300px; }
    </style>
</head>
<body>
    <h2>Scan NFC</h2>
    <p>Silakan tempelkan kartu NFC ke perangkat</p>

    <button onclick="readTag()">Test NFC Read</button>
    <button onclick="writeTag()">Test NFC Write</button>

    <input type="text" id="nfc_code" name="nfc_code" placeholder="Kode NFC" readonly>

    <script>
        async function readTag() {
            if ("NDEFReader" in window) {
                const ndef = new NDEFReader();
                try {
                await ndef.scan();
                ndef.onreading = event => {
                    const decoder = new TextDecoder();
                    for (const record of event.message.records) {
                        document.getElementById("nfc_code").value = decoder.decode(record.data);
                    }
                }
                } catch(error) {
                console.log(error);
                }
            } else {
                console.log("Web NFC is not supported.");
            }
            }

            async function writeTag() {
            if ("NDEFReader" in window) {
                const ndef = new NDEFReader();
                try {
                await ndef.write("Check out web.dev! edit");
                } catch(error) {
                console.log(error);
                }
            } else {
                console.log("Web NFC is not supported.");
            }
            }
    </script>
</body>
</html>