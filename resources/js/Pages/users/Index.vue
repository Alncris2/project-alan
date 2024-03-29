<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
// import 'datatables.net-select';
// import 'datatables.net-responsive';
</script>

<template>
    <AppLayout title="Usuários">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Usuários
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Usuários</h3>
                    </div>
                    <div class="card-body">
                        <DataTable
                            class="border-collapse border border-slate-500"
                        >
                            <thead>
                                <tr>
                                    <th class="border-collapse border border-slate-500">First</th>
                                    <th class="border-collapse border border-slate-500">Second</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                    <div class="card-footer">
                        <a
                            href="{{ route('users.create') }}"
                            class="btn btn-primary"
                            >Novo Usuário</a
                        >
                        <a
                            href="{{ route('users.export') }}"
                            class="btn btn-success"
                            >Exportar</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
