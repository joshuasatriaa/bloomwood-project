<template>
  <div class="container">
    <h1>Invoice Details</h1>
    <button class="btn btn-danger text-white px-4">Cancel Invoice</button>
    <div v-if="invoice.data">
      <div class="row mt-4">
        <div class="col-12 col-md-10 mx-auto">
          <div class="card border-0 shadow rounded-2">
            <div class="card-body">
              <h5
                class="
                  fw-bold
                  text-uppercase
                  border-start border-5 border-primary
                "
              >
                <span class="ms-3">Invoice Info</span>
              </h5>
              <table class="mt-3">
                <tbody>
                  <tr v-for="item in invoiceTable.invoiceInfo" :key="item.id">
                    <th class="text-uppercase fw-bolder">{{ item.label }}</th>
                    <td>{{ inv[item.property] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-md-10 mx-auto">
          <div class="card border-0 shadow rounded-2">
            <div class="card-body">
              <h5
                class="
                  fw-bold
                  text-uppercase
                  border-start border-5 border-warning
                "
              >
                <span class="ms-3">Database Customer Info</span>
              </h5>
              <table class="mt-3">
                <tbody>
                  <tr v-for="item in invoiceTable.userInfo" :key="item.id">
                    <th class="text-uppercase fw-bolder">{{ item.label }}</th>
                    <td>{{ inv.user[item.property] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-md-10 mx-auto">
          <div class="card border-0 shadow rounded-2">
            <div class="card-body">
              <h5
                class="
                  fw-bold
                  text-uppercase
                  border-start border-5 border-danger
                "
              >
                <span class="ms-3">Delivery Info</span>
              </h5>
              <h4 v-if="inv.pick_up">
                <span class="badge bg-primary">SELF PICK UP</span>
              </h4>
              <h4 v-else>
                <span class="badge bg-danger">DELIVERY</span>
              </h4>
              <div v-if="!inv.pick_up">
                <table class="mt-3">
                  <tbody>
                    <tr
                      v-for="item in invoiceTable.deliveryInfo"
                      :key="item.id"
                    >
                      <th class="text-uppercase fw-bolder">{{ item.label }}</th>
                      <td>
                        <span v-if="item.id == 'DeliveryFee'">{{
                          $currencyFormat(inv[item.property])
                        }}</span>
                        <span v-else>{{ inv[item.property] }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-md-10 mx-auto">
          <div class="card border-0 shadow rounded-2">
            <div class="card-body">
              <h5
                class="
                  fw-bold
                  text-uppercase
                  border-start border-5 border-success
                "
              >
                <span class="ms-3">Payment Info</span>
              </h5>
              <table class="mt-3">
                <tbody>
                  <tr v-for="item in invoiceTable.paymentInfo" :key="item.id">
                    <th class="text-uppercase fw-bolder">{{ item.label }}</th>
                    <td>
                      {{
                        item.isCurrency
                          ? $currencyFormat(inv[item.property])
                          : inv[item.property]
                      }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12 col-md-10 mx-auto">
          <div class="card border-0 shadow rounded-2">
            <div class="card-body">
              <h5
                class="
                  fw-bold
                  text-uppercase
                  border-start border-5 border-primary
                "
              >
                <span class="ms-3">Purchased Products</span>
              </h5>
              <div
                v-for="(product, index) in inv.products_detail"
                :key="product.id"
                class="row mt-4"
              >
                <div
                  class="
                    col-12 col-lg-4
                    d-flex
                    flex-row
                    justify-content-evenly
                    align-items-center
                  "
                >
                  <div class="flex-shrink-1">
                    <h5 class="mb-0 text-primary fw-bold">
                      {{ index + 1 }}
                    </h5>
                  </div>
                  <div>
                    <img
                      :src="
                        $getFullImageUrl('/storage/' + product.thumbnail_image)
                      "
                      class="rounded shadow"
                      style="object-fit: cover"
                      width="175"
                      height="125"
                    />
                  </div>
                </div>
                <div
                  class="
                    col-12 col-lg-8
                    d-flex
                    justify-content-center
                    align-items-end
                    mt-3 mt-lg-0
                    pe-3
                  "
                >
                  <table>
                    <tbody>
                      <tr
                        v-for="item in invoiceTable.purchasedProducts"
                        :key="item.id"
                      >
                        <th class="text-uppercase fw-bolder">
                          {{ item.label }}
                        </th>
                        <td v-if="item.property === 'price'">
                          {{ $currencyFormat(product[item.property]) }}
                        </td>
                        <td v-else-if="item.property === 'size'">
                          {{ product[item.property]['name'] }}
                        </td>
                        <td v-else>
                          {{ product[item.property] }}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" class="pt-2">
                          <NuxtLink
                            :to="`/products/${product.id}`"
                            class="btn btn-sm btn-primary w-100"
                            >View</NuxtLink
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-10 mx-auto mt-4">
                  <h5>Custom Message</h5>
                  <p class="bg-light p-4 rounded">{{ product.message }}</p>
                </div>
                <div
                  v-if="product.add_ons.length > 0"
                  class="col-10 mx-auto overflow-auto mt-3"
                >
                  <h5>Chosen Add Ons</h5>
                  <table class="table table-hover table-borderless w-100">
                    <tbody>
                      <tr v-for="addOn in product.add_ons" :key="addOn.id">
                        <td>
                          {{ addOn.name }}
                        </td>
                        <td>
                          {{ $currencyFormat(addOn['price']) }}
                        </td>
                        <td class="text-center">
                          <img
                            :src="
                              $getFullImageUrl(
                                '/storage/' + addOn.thumbnail_image
                              )
                            "
                            width="60"
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div
                  v-if="Object.keys(product.variant).length > 0"
                  class="col-10 mx-auto overflow-auto mt-4"
                >
                  <h5>Chosen Variant</h5>
                  <table class="table table-hover table-borderless w-100">
                    <tbody>
                      <tr>
                        <td>
                          {{ product.variant.name }}
                        </td>
                        <td>
                          {{ $currencyFormat(product.variant['price']) }}
                        </td>
                        <td class="text-center">
                          <img
                            :src="
                              $getFullImageUrl(
                                '/storage/' + product.variant.thumbnail_image
                              )
                            "
                            width="60"
                          />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-12 col-md-10 mx-auto mt-4 text-end">
                  <h5 class="fw-bold">
                    Total Price: {{ $currencyFormat(product.total_price) }}
                  </h5>
                </div>
                <hr class="my-3" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useGetInvoice } from '@/composables/useInvoice'
export default {
  middleware: 'auth',
  setup() {
    const { invoice } = useGetInvoice()
    return { invoice }
  },

  data() {
    return {
      invoiceTable: {
        invoiceInfo: [
          // {
          //   id: 'invoiceId',
          //   label: 'ID',
          //   property: 'id',
          // },
          {
            id: 'invoiceNumber',
            label: 'Invoice Number',
            property: 'invoice_number',
          },
          {
            id: 'invoiceCreatedAt',
            label: 'Issued At',
            property: 'created_at_format',
          },
        ],
        userInfo: [
          // {
          //   id: 'userId',
          //   label: 'User ID',
          //   property: 'id',
          // },
          {
            id: 'userName',
            label: 'Name',
            property: 'name',
          },
          {
            id: 'userEmail',
            label: 'Email',
            property: 'email',
          },
          {
            id: 'userPhoneNumber',
            label: 'Phone',
            property: 'phone_number',
          },
        ],
        purchasedProducts: [
          {
            id: 'productId',
            label: 'Product ID',
            property: 'id',
          },
          {
            id: 'productName',
            label: 'Name',
            property: 'name',
          },
          {
            id: 'productSize',
            label: 'Size',
            property: 'size',
          },
          {
            id: 'productPrice',
            label: 'Price',
            property: 'price',
          },
        ],
        addOnsProduct: [
          {
            id: 'addOnName',
            label: 'Name',
            property: 'name',
          },
          {
            id: 'addOnPrice',
            label: 'Price',
            property: 'price',
          },
        ],
        deliveryInfo: [
          {
            id: 'Address',
            label: 'Address',
            property: 'address',
          },
          {
            id: 'RecipientsName',
            label: "Recipient's Name",
            property: 'recipients_name',
          },
          {
            id: 'RecipientsPhone',
            label: "Recipient's Phone",
            property: 'recipients_phone',
          },
          {
            id: 'DeliveryTime',
            label: 'Delivery Time',
            property: 'delivery_time',
          },
          {
            id: 'DeliveryFee',
            label: 'Delivery Fee',
            property: 'delivery_fee',
          },
        ],
        paymentInfo: [
          {
            id: 'Status',
            label: 'Status',
            property: 'status',
            isCurrency: false,
          },
          {
            id: 'Grandtotal',
            label: 'Grand Total',
            property: 'grand_total',
            isCurrency: true,
          },
        ],
      },
    }
  },
  computed: {
    inv() {
      return this.invoice.data ?? {}
    },
  },
}
</script>

<style scoped>
th,
td {
  min-width: 12rem;
}

th,
td {
  vertical-align: middle;
}

.flex-shrink-0 {
  min-width: 10rem;
}
</style>
