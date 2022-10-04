<template>
  <div>
    <b-modal
      id="forced"
      title="Client Side Fixed Values Validation"
      hide-footer
      size="lg"
    >
      <b-card bg-variant="light">
        <b-form validated @submit.prevent="submitForm">
          <b-row>
            <b-col cols="4">
              <b-card class="mt-3" header="Form request:">
                <pre class="m-0">{{ form }}</pre>
              </b-card>
            </b-col>

            <b-col cols="8">
              <b-form-group
                label="Supplier:"
                label-for="0"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="0"
                  v-model="form.supplier_id"
                  required
                  :options="suppliers"
                  text-field="name"
                  value-field="id"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Species:"
                label-for="1"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="1"
                  v-model="form.species"
                  required
                  :options="species"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Grading system:"
                label-for="2"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="2"
                  v-model="form.grading_system"
                  required
                  :options="accepted_grading_systems"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Drying method:"
                label-for="3"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="3"
                  v-model="form.drying_method"
                  required
                  :options="accepted_drying_method"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Treatment:"
                label-for="4"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="4"
                  v-model="form.treatment"
                  required
                  :options="accepted_treatment"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Thickness:"
                label-for="5"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="5"
                  v-model="form.thickness"
                  required
                  :options="availableThickness"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Width:"
                label-for="6"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="6"
                  v-model="form.width"
                  required
                  :options="availableWidth"
                ></b-form-select>
              </b-form-group>

              <b-form-group
                label="Length:"
                label-for="7"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  id="7"
                  v-model="form.length"
                  required
                  :options="availableLength"
                ></b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <b-button-group class="d-flex justify-content-around">
            <b-button
              variant="success"
              class="mt-2"
              :disabled.sync="isDisabled"
              type="submitForm"
              >Save</b-button
            >
          </b-button-group>
        </b-form>
      </b-card>
    </b-modal>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'ClientSideFixedValidation',
  data() {
    return {
      schema: {
        species: 'Pine',
        grading_system: 'a5',
        drying_method: 'Fresh',
        treatment: 'Heat Treated',
        thickness: 90,
        width: 100,
        length: 2000,
      },
      form: {
        supplier_id: null,
        species: null,
        grading_system: null,
        drying_method: null,
        treatment: null,
        thickness: null,
        width: null,
        length: null,
      },
      species: ['Pine', 'Spruce', 'Fir', 'Birch', 'Apple Tree'],
      accepted_grading_systems: [
        'A1',
        'A2',
        'A3',
        'A4',
        'B',
        'O',
        'I',
        'II',
        'III',
        'IV',
        'V',
      ],
      accepted_drying_method: ['Fresh', 'Kiln Dried', 'Air Dried'],
      accepted_treatment: ['Heat Treated', 'Anti-stain Treatment'],
      someDimensions: [
        {
          thickness: 50,
          width: 90,
          length: 1200,
        },
        {
          thickness: 90,
          width: 100,
          length: 2000,
        },
        {
          thickness: 90,
          width: 120,
          length: 3000,
        },
        {
          thickness: 50,
          width: 120,
          length: 1200,
        },
      ],
    }
  },
  computed: {
    ...mapState(['suppliers']),
    availableThickness() {
      return this.someDimensions.map((v) => v.thickness)
    },
    availableWidth() {
      return this.someDimensions.map((v) => v.width)
    },
    availableLength() {
      return this.someDimensions.map((v) => v.length)
    },
    isDisabled() {
      return Object.values(this.form).includes(null)
    },
  },
  methods: {
    async submitForm() {
      try {
        const response = await this.$axios.post('/api/products', this.form)
        if (response.status === 200) {
          this.$store.commit('newNotification', {
            title: 'Success!',
            body: response.data.message,
            variant: 'success',
          })
          this.resetForm()
          this.$bvModal.hide('forced')
          this.$store.commit('addProduct', {
            data: response.data.data,
          })
        }
      } catch (_) {}
    },
    resetForm() {
      Object.keys(this.form).forEach((key) => (this.form[key] = null))
    },
  },
}
</script>

<style scoped></style>
