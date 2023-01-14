<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"></script>

<!-- <script src="https://apps.len-telko.co.id/OneSignalSDKWorker.js"></script> -->

<script defer>
    // OneSignal.log.setLevel('trace');

    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.SERVICE_WORKER_PARAM = {
            scope: '/'
        };
        OneSignal.init({
            // appId: "967db730-3083-46ce-bba1-4d58ac775e94", // apps,len-telko
            // appId: "539e467a-dd56-43fb-a40a-c3eead933bae", // localhost
            appId: "<?= $this->config->item('app_id') ?>", // config
            safari_web_id: "<?= $this->config->item('safari_web_id') ?>",

            allowLocalhostAsSecureOrigin: true,
            subdomainName: "hisyambsa",

            // safari_web_id: "web.onesignal.auto.44737891-769a-4856-a052-0f3c947190031",
            // 44737891-769a-4856-a052-0f3c94719003
            // Your Safari Web ID: web.onesignal.auto .44737891 - 769 a - 4856 - a052 - 0 f3c94719003
            // Your App ID: 539e467a-dd56-43fb-a40a-c3eead933bae
            welcomeNotification: {
                disable: false,
            },
            notifyButton: {
                enable: false,
            }, // Your other init options here
            promptOptions: {
                slidedown: {
                    actionMessage: "Izinkan Aplikasi mengirim Notfikasi?",
                    acceptButtonText: "IZINKAN",
                    cancelButtonText: "LAIN KALI",
                },
                customlink: {
                    enabled: true,
                    /* Required to use the Custom Link */
                    style: "button",
                    /* Has value of 'button' or 'link' */
                    size: "medium",
                    /* One of 'small', 'medium', or 'large' */
                    color: {
                        button: '#E12D30',
                        /* Color of the button background if style = "button" */
                        text: '#FFFFFF',
                        /* Color of the prompt's text */
                    },
                    text: {
                        subscribe: "Subscribe to push notifications",
                        /* Prompt's text when not subscribed */
                        unsubscribe: "Unsubscribe from push notifications",
                        /* Prompt's text when subscribed */
                        explanation: "berikan izin Notifikasi untuk Apps.len-telko.co.id ? klik allow/izinkan",
                        /* Optional text appearing before the prompt button */
                    },
                    unsubscribeEnabled: true,
                    /* Controls whether the prompt is visible after subscription */
                }
            },
        });
    });
</script>
<script>
    $(document).ready(function() {


        let otVersion = false;
        const butSet = document.getElementById('butSet');
        const butClear = document.getElementById('butClear');
        const inputBadgeVal = $('#badge_waiting').text();

        const butMakeXHR = document.getElementById('butMakeXHR');

        // Check if the API is supported.
        if ('setExperimentalAppBadge' in navigator) {
            isSupported('v2')
        }

        // Check if the previous API surface is supported.
        if ('ExperimentalBadge' in window) {
            isSupported('v1');
        }

        // Check if the previous API surface is supported.
        if ('setAppBadge' in navigator) {
            isSupported('v3');
        }

        // Check if the previous API surface is supported.
        if ('setClientBadge' in navigator) {
            isSupported('v4');
        }

        // Update the UI to indicate whether the API is supported.
        function isSupported(kind) {
            console.log('supported', kind);
            // const divNotSupported = document.getElementById('notSupported');
            // divNotSupported.classList.toggle('hidden', true);
            // butSet.removeAttribute('disabled');
            // butClear.removeAttribute('disabled');
            // inputBadgeVal.removeAttribute('disabled');

            // butMakeXHR.removeAttribute('disabled');
        }
        console.log(inputBadgeVal);
        const val = parseInt(inputBadgeVal);
        if (isNaN(val)) {
            setBadge(0);
        } else {
            setBadge(val);
        }


        // Click event handler for Clear button.
        // butClear.addEventListener('click', () => {
        //     clearBadge();
        // });

        // butMakeXHR.addEventListener('click', () => {
        //     fetch('/manifest.json');
        // });

        // Wrapper to support first and second origin trial
        // See https://web.dev/badging-api/ for details.
        function setBadge(...args) {
            if (navigator.setClientBadge) {
                navigator.setClientBadge(...args);
            } else if (navigator.setAppBadge) {
                navigator.setAppBadge(...args);
            } else if (navigator.setExperimentalAppBadge) {
                navigator.setExperimentalAppBadge(...args);
            } else if (window.ExperimentalBadge) {
                window.ExperimentalBadge.set(...args);
            }
        }

        // Wrapper to support first and second origin trial
        // See https://web.dev/badging-api/ for details.
        function clearBadge() {
            if (navigator.clearAppBadge) {
                navigator.clearAppBadge();
            } else if (navigator.clearExperimentalAppBadge) {
                navigator.clearExperimentalAppBadge();
            } else if (window.ExperimentalBadge) {
                window.ExperimentalBadge.clear();
            }
        }
    });
</script>