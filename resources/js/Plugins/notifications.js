import { router, usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const toast = useToast();
const page = usePage();

export const notifications = () => {
    router.on('finish', () => {
        // console.log("page has been change")

        const message = page.props.message;

        // console.log(message);

        if (message.body) {
            // console.log(message)
            toast(message.body, {
                type: message.type,
            });
        }

    })
}
