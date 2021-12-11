<template>
  <div class="flex-auto">
    <div class="col-3" style="margin-bottom: 40px">
      <h3>Draggable 1 -----</h3>
      <draggable
        class="list-group"
        :list="list1"
        group="people"
        itemKey="name"
      >
        <template #item="{ element, index }">
          <div class="list-group-item">{{ element.name }} {{ index }}</div>
        </template>
      </draggable>
    </div>

    <div class="col-3" style="margin-bottom: 40px">
      <h3>Draggable 2 -----</h3>
      <draggable
        class="list-group"
        :list="list2"
        group="people"
        itemKey="name"
      >
        <template #item="{ element, index }">
          <div class="list-group-item">{{ element.name }} {{ index }}</div>
        </template>
      </draggable>
    </div>
  </div>
  <div class="flex-auto">
    <div class="col-3">
      <h3>Draggable 3 -------</h3>
      <draggable
        class="list-group"
        :list="list3"
        group="people"
        itemKey="name"
      >
        <template #item="{ element, index }">
          <div class="list-group-item">{{ element.name }} {{ index }}</div>
        </template>
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";

export default {
  name: "two-lists",
  display: "Two Lists",
  order: 1,
  components: {
    draggable,
  },
  data() {
    return {
      list1: [
        { name: "Amit", id: 1 },
        { name: "Swati", id: 2 },
        { name: "Suman", id: 3 },
        { name: "Shyama", id: 4 },
      ],
      list2: [
        { name: "Priyanka", id: 5 },
        { name: "Guddi", id: 6 },
        { name: "Kuttush", id: 7 },
      ],
      list3: [
        { name: "Kutkuti", id: 8 },
        { name: "xxxxx", id: 9 },
        { name: "yyyyyyy", id: 10 },
      ],
    };
  },
  methods: {
    // add: function () {
    //   this.list.push({ name: "Juan" });
    // },
    // replace: function () {
    //   this.list = [{ name: "Edgard" }];
    // },
    // clone: function (el) {
    //   return {
    //     name: el.name + " cloned",
    //   };
    // },
    // log: function (evt) {
    //   window.console.log(evt);
    // },
  },
};
</script>
