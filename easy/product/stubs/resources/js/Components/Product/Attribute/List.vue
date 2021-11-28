<template>
  <easy-table
    :tableHead="tableHead"
    :tableData="$page.props.attributes.data"
    :pagination="$page.props.attributes.links"
  >
    <template #cell-actions="{ row }">
        <Link :href="getEditURL(row)" class="ml-4"> <i class="mdi mdi-pencil" aria-hidden="true"></i> Edit </Link>
    </template>
  </easy-table>
</template>

<script>
import EasyTable from "@/Components/Table.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    EasyTable,
    Link,
  },
  setup() {
    const tableHead = [
      {
        id: 1,
        align: "text-left",
        label: "Code",
        column: "code",
      },
      {
        id: 2,
        align: "text-center",
        label: "Level",
        column: "level",
      },
      {
        id: 3,
        align: "text-center",
        label: "Type",
        column: "input",
      },
      {
        id: 4,
        align: "text-center",
        label: "User Defined",
        column: "user_defined",
      },
      {
        id: 5,
        align: "text-center",
        label: "Show in frontend",
        column: "show_in_frontend_features",
      },
      {
        id: 7,
        align: "text-right",
        label: "Action",
        column: "actions",
      },
    ];
    const getEditURL = (row) => {
      return route('admin.product.attribute.edit', {
          type: row.input,
          id: row.id
      })
    };
    return { tableHead, getEditURL };
  },
};
</script>
