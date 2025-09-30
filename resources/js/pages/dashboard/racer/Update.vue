<script setup lang="ts">
import RaceController from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import RacerController from '@/actions/App/Http/Controllers/Dashboard/RacerController';
import { formatDate } from '@/lib/utils';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import Heading from '@/components/Heading.vue';
import { LoaderCircle } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';
import { index } from '@/routes/racer';

interface Race {
    id: number;
    name: string;
    start_at: string;
    end_at: string;
}

interface Racer {
    id: number;
    name: string;
    nickname: string;
    email: string;
    age: string;
    flight_license: string;
    license_plate: string;
}

const props = defineProps<{
    race: Race
    racer: Racer
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
        title: 'Update Racer',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Update racer" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Update racer"/>
            </div>

            <Form v-bind="RacerController.update.form({race: props.race.id, racer: racer.id})" v-slot="{ errors, processing }">

                <div class="grid gap-6">
                    <div class="grid gap-6 grid-cols-2">
                        <input type="text" name="race_id" hidden :value="props.race.id" />
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" type="text" name="name" :default-value="racer.name" required />
                            <InputError :message="errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="nickname">Nickname</Label>
                            <Input id="nickname" type="text" name="nickname" :default-value="racer.nickname"/>
                            <InputError :message="errors.nickname" />
                        </div>
                    </div>

                    <div class="grid gap-6 grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" type="email" name="email" :default-value="racer.email"/>
                            <InputError :message="errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="age">Age</Label>
                            <Input id="age" type="text" name="age" :default-value="racer.age"/>
                            <InputError :message="errors.age" />
                        </div>
                    </div>

                    <div class="grid gap-6 grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="flight_license">Flight license</Label>
                            <Input id="flight_license" type="text" name="flight_license" :default-value="racer.flight_license"/>
                            <InputError :message="errors.flight_license" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="license_plate">License plate</Label>
                            <Input id="license_plate" type="text" name="license_plate" :default-value="racer.license_plate"/>
                            <InputError :message="errors.license_plate" />
                        </div>
                    </div>
                </div>

                <Button type="submit" class="mt-4">
                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin"/>
                    Update
                </Button>
            </Form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
