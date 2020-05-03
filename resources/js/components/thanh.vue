<template>
  <section class="calendar">
    <download-excel
    class   = "btn btn-default"
    :data   = "json_data"
    :fields = "json_fields"
    worksheet = "My Worksheet"
    name    = "filename.xls">
 
    Download Excel (you can customize this with html code!)
 
</download-excel>
  </section>
</template>

<script> 
export default {
    
    
  data() {
    return {
      json_fields: {
            'Complete name': 'name',
            'City': 'city',
            'Telephone': 'phone.mobile',
            'Telephone 2' : {
                field: 'phone.landline',
                callback: (value) => {
                    return `Landline Phone - ${value}`;
                }
            },
        },
        json_data: [
            {
                'name': 'Tony Peña',
                'city': 'New York',
                'country': 'United States',
                'birthdate': '1978-03-15',
                'phone': {
                    'mobile': '1-541-754-3010',
                    'landline': '(541) 754-3010'
                }
            },
        ],
        json_meta: [
            [
                {
                    'key': 'charset',
                    'value': 'utf-8'
                }
            ]
        ],
    };
  },
  
  methods: {
    
  },
  
};
</script>

