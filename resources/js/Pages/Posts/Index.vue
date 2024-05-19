<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm, Link, usePage } from '@inertiajs/vue3';

defineProps({
    posts: Object,
    // now: String,
    can: Object,
});

const form = useForm("StorePost", {
    body: "",
});

const createPost = () => {
    form.post(route("posts.store"),{
        onSuccess: () => {
            form.reset();
            // form.body="";
            // toast.success('Post crteated successfully');

        }
    });
};

const refreshPosts = () => {

    // router.visit(route('posts.index'));

    router.get(route("posts.index"),
        {},
        {
            only: ["posts"],
            preserveScroll: true,
            preserveState: true,
        }
    );
};


</script>

<template>
    <Head title="Comments">
        <meta name="description" content="Comments Index" />
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-3">
                <!-- {{ form }} -->
                <!-- {{ page.props.greeting }} -->
                <form v-if="can.post_create"
                    @submit.prevent="createPost"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <label for="body" class="sr-only">Body</label>
                    <textarea
                    v-model="form.body"
                    @focus="form.clearErrors('body')"
                        name="body"
                        id="body"
                        cols="30"
                        rows="5"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                    ></textarea>
                    <p v-if="form.errors.body" class="text-sm text-red-500">
                        {{  form.errors.body }}
                    </p>
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                        :class="{ 'opacity-50': form.processing }"
                    >
                        Post
                    </button>

                </form>

                <!-- {{ now }} -->

                <div class="py-3 flex justify-center">
                    <!-- <button
                        @click="refreshPosts"
                        class="text-sm text-indigo-700"
                        type="button"
                    >
                        Refresh posts
                    </button> -->

                    <Link
                        preserve-scroll
                        preserve-state
                        :only="['posts']"
                        :href="route('posts.index')"
                        class="text-sm text-indigo-700"
                    >
                        Refresh posts
                    </Link>
                </div>

                <div v-for="post in posts.data" :key="post.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">
                                {{ post.body }}
                            </div>

                            <p class="mt-1">
                                {{ post.cteated_at }} - {{ post.user.name }}
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
