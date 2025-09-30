<script setup lang="ts">
import RaceController from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import RacerController from '@/actions/App/Http/Controllers/Dashboard/RacerController';
import { LoaderCircle } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import type { BreadcrumbItem } from '@/types';
import race from '@/routes/race';
import { dashboard } from '@/routes';
import { index } from '@/routes/racer';

interface Race {
    id: number;
    name: string;
    start_at: string;
    end_at: string;
}

const props = defineProps<{
    race: Race
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Races',
        href: RaceController.index().url,
    },
    {
        title: props.race.name,
        href: index(props.race.id).url,
    },
    {
        title: 'Create Racer',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Create racer" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Create racer" />
            </div>

            <Form v-bind="RacerController.store.form(props.race.id)"
                v-slot="{ errors, processing }"
            >
                <div class="grid gap-6">
                    <div class="grid gap-6 grid-cols-2">
                        <input type="text" name="race_id" hidden :value="props.race.id" />
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" type="text" name="name" required />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="nickname">Nickname</Label>
                            <Input id="nickname" type="text" name="nickname"/>
                            <InputError :message="errors.nickname" />
                        </div>
                    </div>

                    <div class="grid gap-6 grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" type="email" name="email"/>
                            <InputError :message="errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="age">Age</Label>
                            <Input id="age" type="text" name="age"/>
                            <InputError :message="errors.age" />
                        </div>
                    </div>

                    <div class="grid gap-6 grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="flight_license">Flight license</Label>
                            <Input id="flight_license" type="text" name="flight_license"/>
                            <InputError :message="errors.flight_license" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="license_plate">License plate</Label>
                            <Input id="license_plate" type="text" name="license_plate"/>
                            <InputError :message="errors.license_plate" />
                        </div>
                    </div>
                </div>

                <Button type="submit" class="mt-4">
                    <LoaderCircle
                        v-if="processing"
                        class="h-4 w-4 animate-spin"
                    />
                    Create
                </Button>
            </Form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
