<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';
import Heading from '@/components/Heading.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { create, edit, destroy, } from '@/actions/App/Http/Controllers/Dashboard/RaceController';
import { index } from '@/routes/racer';
import { formatDate } from '@/lib/utils';

interface Race {
    id: number;
    name: string;
    start_at: string;
    end_at: string;
}

defineProps<{
    races: Race[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Races',
        href: dashboard().url,
    },
];

const confirmDestroy = (id: number) => {
    if (confirm('Are you sure you want to delete this race?')) {
        router.delete(destroy(id).url);
    }
};
</script>

<template>
    <Head title="Races" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid grid-cols-2">
                <Heading title="Races" description="All races" />
                <div class="flex flex-row-reverse">
                    <Link :href="create.url()">
                        <Button variant="outline" size="sm" as="a">Create race</Button>
                    </Link>
                </div>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Started at</TableHead>
                        <TableHead>End at</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="race in races" :key="race.id">
                        <TableCell class="font-medium">
                            {{ race.name }}
                        </TableCell>
                        <TableCell>{{ formatDate(race.start_at) }}</TableCell>
                        <TableCell>{{ formatDate(race.end_at) }}</TableCell>
                        <TableCell class="text-right">
                            <Link :href="index(race.id)">
                                <Button variant="outline" size="sm" as="a">Log in race</Button>
                            </Link>
                            <Link :href="edit.url(race.id)">
                                <Button as="a" variant="outline" size="sm">Edit</Button>
                            </Link>
                            <Button variant="destructive" size="sm" @click="confirmDestroy(race.id)">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>

<style scoped></style>
