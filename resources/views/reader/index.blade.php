<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFC Tag Reader</title>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nfcInput = document.getElementById("nfc_code");

            nfcInput.focus();

            // pengecekan apakah browser mendukung Web NFC
            if ("NDEFReader" in window) {
                async function scanNFC() {
                    try {
                        const nfcReader = new NDEFReader();
                        await nfcReader.scan();

                        nfcReader.onreading = (event) => {
                            for (const record of event.message.records) {
                                if (record.recordType === "text") {
                                    const decoder = new TextDecoder();
                                    nfcInput.value = decoder.decode(record.data);
                                    break;
                                }
                            }
                        };
                    } catch (error) {
                        console.error("Gagal membaca NFC:", error);
                    }
                }

                scanNFC();
            } else {
                console.warn("Web NFC tidak didukung di browser ini.");
            }
        });
    </script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        input { padding: 10px; font-size: 18px; width: 80%; max-width: 300px; }
    </style>
</head>
<body>
    <h2>Scan NFC</h2>
    <p>Silakan tempelkan kartu NFC ke perangkat</p>

    <input type="text" id="nfc_code" name="nfc_code" placeholder="Kode NFC" readonly>
</body>
</html>