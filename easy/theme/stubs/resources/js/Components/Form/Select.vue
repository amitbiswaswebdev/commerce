<template>
  <div>
    <easy-label for="rule" value="Validation" />
    <div class="select-cover relative" ref="customselect">
      <div
        class="
          mt-1
          p-2
          block
          w-full
          bg-white
          border-gray-300
          shadow-sm
          cursor-pointer
          selected
        "
        :style="selectedStyle"
        @click="showOptions = !showOptions"
      >
        <template v-if="selected.length">
          <span
            v-for="(item, index) in selected"
            :key="index"
            class="bg-gray-100 py-1 px-2 mx-1 rounded-full"
          >
            {{ item.label }}
          </span>
        </template>
        <span v-else>
          <template v-if="multiple"> Please select options. </template>
          <template v-else> Please select an option. </template>
        </span>
      </div>
      <div
        v-show="showOptions"
        class="fixed inset-0 z-40"
        @click="showOptions = false"
      ></div>
      <ul
        class="
          options
          absolute
          bg-white
          w-full
          rounded-bl-md rounded-br-md
          border-gray-300
          overflow-y-auto
          max-h-40
          z-50
        "
        :class="{ invisible: !showOptions }"
        :style="dropDownStyle"
        ref="customDropDown"
      >
        <template v-if="options.length">
          <li
            v-for="(option, index) in options"
            :key="index"
            class="cursor-pointer px-2 py-1 hover:bg-gray-100"
            @click="toggleOption(option, index)"
          >
            {{ option.label }}
          </li>
        </template>
        <li v-else class="cursor-pointer px-2 py-1 hover:bg-gray-100">
          No options available for now.
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import EasyLabel from "@/Components/Form/Label.vue";
import EasyInputError from "@/Components/Form/InputError.vue";
export default {
  name: "EasySelect",
  components: {
    EasyLabel,
    EasyInputError,
  },
  data() {
    return {
      multiple: false,
      showOptions: false,
      dropDownStyle: {
        marginTop: "0px",
        boxShadow: "0px 9px 10px 0px rgba(0,0,0,0.1)",
        borderWidth: "0px 1px 1px 1px",
        borderRadius: "0px 0px 6px 6px",
      },
      selectedStyle: {
        borderRadius: "6px 6px 6px 6px",
      },
      marginTop: 0,
      selected: [],
      options: [
        {
          value: "option-1",
          label: "Option One",
        },
        {
          value: "option-2",
          label: "Option Two",
        },
        {
          value: "option-3",
          label: "Option Three",
        },
        {
          value: "option-4",
          label: "Option Four",
        },
      ],
    };
  },
  watch: {
    showOptions: function (val) {
      if (val) {
        let bottomPosition =
          this.$refs.customselect.getBoundingClientRect().bottom;
        let topPosition = this.$refs.customselect.getBoundingClientRect().top;
        let screenHeight = window.innerHeight;
        let dropDownHeight = this.$refs.customDropDown.clientHeight;
        if (screenHeight - bottomPosition < dropDownHeight) {
          this.dropDownStyle.marginTop =
            -(dropDownHeight + 1 + (bottomPosition - topPosition)) + "px";
          this.dropDownStyle.boxShadow = "0px -10px 10px 0px rgba(0,0,0,0.1)";
          this.dropDownStyle.borderRadius = "6px 6px 0px 0px";
          this.dropDownStyle.borderWidth = "1px 1px 0px 1px";
          this.selectedStyle.borderRadius = "0px 0px 6px 6px";
        } else {
          this.selectedStyle.borderRadius = "6px 6px 0px 0px";
        }
      } else {
        this.dropDownStyle.marginTop = "0px";
        this.dropDownStyle.boxShadow = "0px 9px 10px 0px rgba(0,0,0,0.1)";
        this.dropDownStyle.borderRadius = "0px 0px 6px 6px";
        this.dropDownStyle.borderWidth = "0px 1px 1px 1px";
        this.selectedStyle.borderRadius = "6px 6px 6px 6px";
      }
    },
  },
  methods: {
    toggleOption(option) {
      let index = null;
      if (
        this.selected.length &&
        (index = this.selected.indexOf(option)) > -1
      ) {
        this.selected.splice(index, 1);
      } else {
        if (this.multiple) {
          this.selected.push(option);
        } else {
          this.selected = [option];
          this.showOptions = false;
        }
      }
      // emit data
    },
  },
};
</script>

<style scoped>
.selected {
  border-width: 1px;
}
</style>
