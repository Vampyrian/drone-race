<script setup lang="ts">
import RacerController from '@/actions/App/Http/Controllers/Dashboard/RacerController';
import RaceController, { destroy, } from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import { index } from '@/routes/racer';
import AppLayout from '@/layouts/AppLayout.vue';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Head, Link, router } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import type { BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';

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
    race: Race;
    racers: Racer[];
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
        title: 'Racers',
        href: dashboard().url,
    },
];
const confirmDestroy = (id: number) => {
    if (confirm('Are you sure you want to delete this racer?')) {
        router.delete(RacerController.destroy({race: props.race.id, racer: id}));
    }
};
</script>

<template>
    <Head title="Races" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Racers" description="All racers" />
                <div class="flex flex-row-reverse">
                    <Link :href="RacerController.create.url(race.id)">
                        <Button variant="outline" size="sm" as="a">Create racer</Button>
                    </Link>
                </div>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Nickname</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Age</TableHead>
                        <TableHead>Flight license</TableHead>
                        <TableHead>License plate</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="racer in racers" :key="racer.id">
                        <TableCell class="font-medium">{{racer.name }}</TableCell>
                        <TableCell>{{ racer.nickname }}</TableCell>
                        <TableCell>{{ racer.email }}</TableCell>
                        <TableCell>{{ racer.age }}</TableCell>
                        <TableCell>{{ racer.flight_license }}</TableCell>
                        <TableCell>{{ racer.license_plate }}</TableCell>
                        <TableCell class="text-right">
                            <Link :href="RacerController.edit.url({race: props.race.id,racer: racer.id})">
                                <Button as="a" variant="outline" size="sm">Edit</Button>
                            </Link>
                            <Button variant="destructive" size="sm" @click="confirmDestroy(racer.id)">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>

<style scoped></style>
