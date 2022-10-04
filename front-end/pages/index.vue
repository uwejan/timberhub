<template>
  <div>
    <lazy-client-side-validation></lazy-client-side-validation>
    <lazy-client-side-fixed-validation></lazy-client-side-fixed-validation>
    <lazy-server-side-validation></lazy-server-side-validation>
    <b-card-body>
      <b-table
        striped
        hover
        :items="products"
        :fields="fields"
        :busy="!products"
        :sort-desc="true"
        sort-by="created_at"
      >
      </b-table>

      <div class="m-3 text-center">
        <b-button-group>
          <b-button v-b-modal:server size="xl m-1" variant="info"
            >Add Product: Server Side Validation
          </b-button>
          <b-button v-b-modal:client size="xl m-1" variant="info"
            >Add Product: Client Side Validation
          </b-button>
          <b-button v-b-modal:forced size="xl m-1" variant="info"
            >Add Product: Fixed Validation
          </b-button>
        </b-button-group>
      </div>
    </b-card-body>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'IndexPage',
  layout: 'MainLayout',
  data() {
    return {
      items: [],
      fields: [
        {
          key: 'id',
          label: 'Id',
          sortable: true,
        },
        {
          key: 'specifications',
          label: 'Specifications / Dimensions',
          sortable: true,
          formatter: 'specificationsFormatter',
        },
        {
          key: 'supplier',
          label: 'Supplier',
          sortable: true,
          formatter: 'supplierFormatter',
        },
      ],
      grading_system: {
        A1: 'Nordic Blue A1',
        A2: 'Nordic Blue A2',
        A3: 'Nordic Blue A3',
        A4: 'Nordic Blue A4',
        B: 'Nordic Blue B',

        O: 'Tegernseer O',
        I: 'Tegernseer I',
        II: 'Tegernseer II',
        III: 'Tegernseer III',
        IV: 'Tegernseer IV',
        V: 'Tegernseer V',
      },
    }
  },
  // async fetch() {
  //   const url = '/api/products'
  //   this.items = await this.$axios.$get(url)
  // },
  computed: {
    ...mapState(['products']),
    pending() {
      return this.$fetchState.pending
    },
  },
  methods: {
    specificationsFormatter(value) {
      // Required format
      // 1. Spruce, Nordic Blue/A1, Fresh, Heat Treated - 50x150x1200

      // Response format
      // { "id": 7, "product_id": 1, "species": "Spruce", "grading_system": "II", "drying_method":
      //   "Air Dried", "treatment": "Heat Treated",
      //   "thickness": 50, "width": 120, "length":
      //   3000, }

      // Client side grading system string use:  ${this.grading_system[value.grading_system]}
      return value
        ? `${value.species},
         ${value.grading_system},
          ${value.drying_method},
           ${value.treatment},
            ${value.thickness}x${value.width}x${value.length}`
        : ''
    },
    supplierFormatter(value) {
      return value ? value.name : ''
    },
  },
}
</script>
