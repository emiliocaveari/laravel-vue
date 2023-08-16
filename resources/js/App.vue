<template>
    <nav
        class="font-sans flex flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-white shadow sm:items-baseline w-full">
        <div class="mb-2 sm:mb-0">
            <a href="#" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark">Pessoas</a>
        </div>
    </nav>
    <div class="container p-4 mx-auto">

        <div v-show="form.show" @submit.prevent="formSave()" class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity flex items-center">
            <form class="w-full h-max max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nome</label>
                    <input v-model="form.data.nome"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        type="text" id="name" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail</label>
                    <input 
                        v-model="form.data.email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        type="email" id="email" name="email" required placeholder="nome@example.com">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cpf">CPF</label>
                    <input v-model="form.data.cpf" v-maska data-maska="###.###.###-##"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        type="text" id="cpf" name="cpf" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cpf">Categoria</label>
                    <select v-model="form.data.categoria_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                        id="categoria" name="categoria" required>
                        <option v-for="option in form.categorias" :key="option.codigo" :value="option.codigo">
                            {{ option.nome }}
                        </option>
                    </select>
                </div>
                <div v-show="form.error.show" class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        {{ form.error.message }}
                    </div>
                </div>
                <button
                    class="w-full bg-indigo-500 text-white text-sm font-bold py-2 px-4 mb-3 rounded-md hover:bg-indigo-600 transition duration-300"
                    type="submit">Confirmar</button>
                <button @click.prevent="form.show = false"
                    class="w-full bg-red-500 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-red-600 transition duration-300"
                    type="button">Cancelar</button>
            </form>

        </div>


        <div v-show="form.showdelete" class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity flex items-center">
            <div class="w-full h-max max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
                <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        Deseja realmente exluir os dados de 
                        <span class="font-medium">{{ form.data.nome  }}</span>? Essa operação não poderá ser desfeita!
                    </div>
                </div>
                <button @click.prevent="form.showdelete = false"
                    class="w-full bg-indigo-500 text-white text-sm font-bold py-2 px-4 mb-3 rounded-md hover:bg-indigo-600 transition duration-300"
                    type="button">Cancelar</button>
                <button
                    @click.prevent="formDelete()"
                    class="w-full bg-red-500 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-red-600 transition duration-300"
                    type="button">Excluir</button>
            </div>

        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Código
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Nome
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        E-mail
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        CPF
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Categoria
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Classificação
                                    </th>
                                    <th scope="col" class="p-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="(pessoa, idx) in pessoas" :key="idx"
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.id }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.nome }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.email }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.cpf }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.categoria }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ pessoa.classificacao }}
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-6">
                                            <button @click.prevent="editPessoa(idx)"
                                                class="text-blue-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                Editar
                                            </button>

                                            <button
                                                @click.prevent="delPessoa(idx)"
                                                class="text-red-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="#" @click.prevent="prevPage"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>
                    previous
                </span>
            </a>

            <div class="items-center hidden md:flex gap-x-3">
                <span
                    class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    {{ page.current }}
                </span> /
                <span
                    class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    {{ page.last }}
                </span>
            </div>

            <a href="#" @click.prevent="nextPage"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <span>
                    Next
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="w-full text-start">
            <button @click.prevent="addPessoa" type="button"
                class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                Adicionar pessoa
            </button>
        </div>

        
    </div>
</template>

<script>
import { vMaska } from "maska"
export default {
    directives: { maska: vMaska },
    // Properties returned from data() become reactive state
    // and will be exposed on `this`.
    data() {

        return {
            pessoas: [],
            page: {
                current: 1,
                last: 1
            },
            count: 0,
            form: {
                show: false,
                showdelete: false,
                error : {
                    show : false,
                    message : ''
                },
                data: {
                    id: '',
                    nome: '',
                    cpf: '',
                    email: '',
                    categoria_id: ''
                },
                categorias: [],
            }
        }
    },

    // Methods are functions that mutate state and trigger updates.
    // They can be bound as event handlers in templates.
    methods: {
        increment() {
            this.count++
        },
        getPessoas() {
            axios.get('/api/pessoa?page=' + this.page.current)
                .then(response => {
                    const data = response.data;
                    this.pessoas = data.data;
                    this.page.current = data.meta.current_page
                    this.page.last = data.meta.last_page
                })
        },
        editPessoa(idx) {
            if (!this.pessoas[idx]) return;

            const pessoa = this.pessoas[idx];
            this.form.data = {
                id: pessoa.id,
                nome: pessoa.nome,
                cpf: pessoa.cpf,
                email: pessoa.email,
                categoria_id: pessoa.categoria_id
            };
            this.form.error.show = false;
            this.form.show = true;
        },
        delPessoa(idx) {
            if (!this.pessoas[idx]) return;
            const pessoa = this.pessoas[idx];
            this.form.data = {
                id: pessoa.id,
                nome: pessoa.nome,
            };
            this.form.showdelete = true;
        },
        addPessoa() {
            this.form.data = {
                id: '',
                nome: '',
                cpf: '',
                email: '',
                categoria_id: 3,
            };
            this.form.error.show = false;
            this.form.show = true;
        },
        getCategorias() {
            axios.get('/api/categoria')
                .then(response => {
                    const data = response.data;
                    this.form.categorias = data.data;
                })
        },
        nextPage() {
            if (this.page.current == this.page.last) return null;
            this.page.current++;
            this.getPessoas();
        },
        prevPage() {
            if (this.page.current == 1) return null;
            this.page.current--;
            this.getPessoas();
        },
        formSave() {
            console.log(this.form.data);
            if (this.form.data.id) {
                axios.put('/api/pessoa/' + this.form.data.id, this.form.data)
                    .then(response => {
                        const data = response.data.data;
                        const idx = this.pessoas.findIndex(i => { return i.id == data.id });
                        this.pessoas[idx] = data;
                        this.form.show = false;
                    })
                    .catch( ({response}) => {
                        this.form.error.message = response.data.message;
                        this.form.error.show = true;
                    })
                } else {
                    axios.post('/api/pessoa', this.form.data)
                    .then(response => {
                        const data = response.data.data;
                        this.pessoas.push(data);
                        this.form.show = false;
                    })
                    .catch( ({response}) => {
                        this.form.error.message = response.data.message;
                        this.form.error.show = true;
                    })
            }
        },
        formDelete() {
            if (this.form.data.id) {
                const id = this.form.data.id
                axios.delete('/api/pessoa/' + id)
                    .then(response => {
                        const idx = this.pessoas.findIndex(i => { return i.id == id });
                        this.getPessoas();
                        this.form.showdelete = false;
                    })
            }
        }

    },

    mounted() {
        this.getPessoas();
        this.getCategorias();
    }
}
</script>