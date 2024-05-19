<script setup lang="ts">
defineProps<{
	posts: Record<string, any>;
}>()
</script>

<template>
	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
	                    <div class="p-6 text-gray-900">{{ posts }}</div>
	                </div>
</template>
