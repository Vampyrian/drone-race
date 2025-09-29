<script setup lang="ts">
import RaceController from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import Heading from '@/components/Heading.vue';
import type { BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';
import race from '@/routes/race';
import {Form} from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Races',
        href: race.index.url(),
    },
    {
        title: 'Create race',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Create race"/>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Create race"/>
            </div>

            <Form v-bind="RaceController.store.form()" v-slot="{ errors, processing }">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="email">Race name</Label>
                        <Input id="email" type="text" name="name" required/>
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-6 grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="email">Race start at</Label>
                            <Input id="email" type="date" name="start_at" required/>
                            <InputError :message="errors.start_at" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Race end at</Label>
                            <Input id="email" type="date" name="end_at" required/>
                            <InputError :message="errors.end_at" />
                        </div>
                    </div>
                </div>

                <Button type="submit" class="mt-4">
                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin"/>
                    Create
                </Button>
            </Form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
