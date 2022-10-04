<template>
  <div>
    <b-modal id="client" title="Client Side Validation" hide-footer size="lg">
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
                  :state="form.supplier_id !== null"
                ></b-form-select>
                <b-form-invalid-feedback>
                  The supplier id field is required.
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Species:"
                label-for="1"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="1"
                  v-model="form.species"
                  required
                  :state="isSpeciesValid"
                  debounce="600"
                ></b-form-input>
                <!-- This will only be shown if the preceding input has an invalid state -->
                <b-form-invalid-feedback>
                  Valid values are: {{ species.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Grading system:"
                label-for="2"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="2"
                  v-model="form.grading_system"
                  required
                  :state="isGradingValid"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ accepted_grading_systems.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Drying method:"
                label-for="3"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="3"
                  v-model="form.drying_method"
                  required
                  :state="isDryingValid"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ accepted_drying_method.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Treatment:"
                label-for="4"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="4"
                  v-model="form.treatment"
                  required
                  :state="isTreatmentValid"
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ accepted_treatment.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Thickness:"
                label-for="5"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="5"
                  v-model="form.thickness"
                  required
                  :state="isThicknessValid"
                  type="number"
                  no-wheel
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ availableThickness.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Width:"
                label-for="6"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="6"
                  v-model="form.width"
                  required
                  :state="isWidthValid"
                  type="number"
                  no-wheel
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ availableWidth.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Length:"
                label-for="7"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="7"
                  v-model="form.length"
                  required
                  :state="isLengthValid"
                  type="number"
                  no-wheel
                  debounce="600"
                ></b-form-input>
                <b-form-invalid-feedback>
                  Valid values are: {{ availableLength.join(', ') }}
                </b-form-invalid-feedback>
              </b-form-group>
            </b-col>
          </b-row>
          <b-button-group class="d-flex justify-content-around">
            <b-button
              variant="success"
              class="mt-2"
              :disabled.sync="isDisabled"
              type="submit"
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
  name: 'ClientSideValidation',
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
          thickness: 100,
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
      return this.someDimensions.map((v) => v.thickness.toString())
    },
    availableWidth() {
      return this.someDimensions.map((v) => v.width.toString())
    },
    availableLength() {
      return this.someDimensions.map((v) => v.length.toString())
    },
    isDisabled() {
      return Object.values(this.form).includes(null)
    },
    isSpeciesValid() {
      const sps = this.species.map((v) => v.toLowerCase())
      return (
        this.form.species !== null &&
        sps.includes(this.form.species.toLowerCase())
      )
    },
    isGradingValid() {
      const sps = this.accepted_grading_systems.map((v) => v.toLowerCase())
      return (
        this.form.grading_system !== null &&
        sps.includes(this.form.grading_system.toLowerCase())
      )
    },
    isDryingValid() {
      const sps = this.accepted_drying_method.map((v) => v.toLowerCase())
      return (
        this.form.drying_method !== null &&
        sps.includes(this.form.drying_method.toLowerCase())
      )
    },
    isTreatmentValid() {
      const sps = this.accepted_treatment.map((v) => v.toLowerCase())
      return (
        this.form.treatment !== null &&
        sps.includes(this.form.treatment.toLowerCase())
      )
    },
    isThicknessValid() {
      return (
        this.form.thickness !== null &&
        this.availableThickness.includes(this.form.thickness)
      )
    },
    isWidthValid() {
      return (
        this.form.width !== null &&
        this.availableWidth.includes(this.form.width)
      )
    },
    isLengthValid() {
      return (
        this.form.length !== null &&
        this.availableLength.includes(this.form.length)
      )
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
          this.$bvModal.hide('client')
          this.$store.commit('addProduct', {
            data: response.data.data,
          })
        }
      } catch (e) {
        this.$store.commit('newNotification', {
          title: 'Invalid!',
          body: e.response.data,
          variant: 'danger',
        })
      }
    },
    resetForm() {
      Object.keys(this.form).forEach((key) => (this.form[key] = null))
    },
  },
}
</script>

<style scoped></style>
