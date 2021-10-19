<template>
    <table v-if="tableHead.length > 0" class="responsive-table w-full bg-white shadow-md">
        <thead class="hidden sm:table-header-group">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th v-if="selectable" class="py-3 px-6 w-6 text-center">
                    Select
                </th>
                <template v-for="tableHeaderItem in tableHead" :key="tableHeaderItem.id">
                    <th class="py-3 px-6" :class="`sm:${tableHeaderItem.align}`">
                        {{tableHeaderItem.label}}
                    </th>
                </template>
            </tr>
        </thead>
        <tbody v-if="tableData.length > 0">
            <tr class="block text-right m-4 sm:table-row border-b border-gray-200 hover:bg-gray-100" v-for="(rowData, rowIndex) in tableData" :key="rowIndex">
                <td v-if="selectable" class="block sm:table-cell py-3 px-6" data-label="Select">
                    <input @change="selectItem($event,rowData)" type="checkbox" class="appearance-none checked:bg-blue-600 checked:border-transparent">
                </td>
                <td class="block sm:table-cell py-3 px-6" v-for="tableHeaderItem in tableHead" :key="tableHeaderItem.id" :data-label="tableHeaderItem.label" :class="`sm:${tableHeaderItem.align}`">
                    <slot :name="`cell-${tableHeaderItem.column}`" :row="rowData">
                        {{rowData[tableHeaderItem.column]}}
                    </slot>
                </td>
            </tr>
        </tbody>
        <tfoot v-if="pagination.length">
            <tr>
                <th :colspan="getColSpan()">
                    <pagination  :links="pagination"/>
                </th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    import pagination from '@/Components/Pagination.vue'
    export default {
        components:{
            pagination
        },
        props:{
            pagination:{
                type: Array,
                required: false,
                default:[]
            },
            selectable : {
                type: Boolean,
                required: false,
                default: false
            },
            tableHead : {
                type: Array,
                required: true,
            },
            tableData : {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                deletIndex: -1,
                selected: []
            }
        },
        methods: {
            selectItem(e,rowData){
                if (e.currentTarget.checked) {
                    this.selected.push(rowData)
                } else {
                    this.deletIndex = this.selected.indexOf(rowData)
                    if (this.deletIndex > -1) {
                        this.selected.splice(this.deletIndex, 1)
                        this.deletIndex = -1;
                    }
                }
                this.$emit('selected',this.selected)
            },
            getColSpan(){
                let columns = this.tableHead.length
                return (this.selectable) ? columns + 1 : columns;
            }
        },
    }
</script>

<style lang="scss" scoped>
@media screen and (max-width: 600px) {
    .responsive-table {
        td {
            &::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    }
}
</style>
