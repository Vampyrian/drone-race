<script setup lang="ts">
import RaceController from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import Heading from '@/components/Heading.vue';
import type { BreadcrumbItem } from '@/types';
import race from '@/routes/race';
import { dashboard } from '@/routes';
import { formatDate } from '@/lib/utils';

interface Race {
    id: number;
    name: string;
    start_at: string;
    end_at: string;
}

defineProps<{
    raceToUpdate: Race
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Races',
        href: race.index.url(),
    },
    {
        title: 'Update race',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Update race" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Update race" />
            </div>


            <Form v-bind="RaceController.update.form(raceToUpdate.id)" v-slot="{ errors, processing }">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Race name</Label>
                        <Input id="name" type="text" name="name" required :default-value="raceToUpdate.name" />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid gap-2">
                            <Label for="start_at">Race start at</Label>
                            <Input id="start_at" type="date" name="start_at" required :default-value="formatDate(raceToUpdate.start_at)" />
                            <InputError :message="errors.start_at" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="end_at">Race end at</Label>
                            <Input id="end_at" type="date" name="end_at" required :default-value="formatDate(raceToUpdate.end_at)"/>
                            <InputError :message="errors.end_at" />
                        </div>
                    </div>
                </div>

                <Button type="submit" class="mt-4">
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Update
                </Button>
            </Form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
