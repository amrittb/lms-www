<script>
    import Moment from "moment";
    import VueDatePicker from "./VueDatePicker.vue";

    const DEFAULT_FORMAT = 'MMM DD, YYYY HH:mm';

    export default {
        data() {
            return {
                /**
                 * Options to pass to VueDatePicker
                 */
                options : {
                    type: 'min',
                    week: ['Su','Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    format: this.dateTimeFormat,
                    placeholder: this.placeHolder,
                    color: {
                        header: '#00796b',
                        headerText: '#fff'
                    },
                    inputStyle: {
                        'display': 'inline-block',
                        'padding': '6px',
                        'line-height': '22px',
                        'font-size': '16px',
                        'border': 'none',
                        'box-shadow': 'none',
                        'border-radius': '0',
                        'color': '#5F5F5F'
                    },
                }
            }
        },
        props: {
            /**
             * Id for label and input
             */
            id: {
                required: false,
                type: String
            },
            /**
             * Name for the input
             */
            name: {
                type: String,
                required: true
            },
            /**
             * Date Time format
             */
            dateTimeFormat: {
                type: String,
                required: false,
                default: DEFAULT_FORMAT
            },
            /**
             * Date Time passed as prop
             */
            dateTime: {
                type: String,
                required: false,
                default: Moment().format(DEFAULT_FORMAT)
            },
            /**
             * Place Holder string
             */
            placeHolder : {
                type: String,
                required: false,
                default: 'When?'
            }
        },
        components : {
            "datepicker" : VueDatePicker
        }
    }
</script>

<template>
    <input type="datetime" :id="id" :placeholder="placeHolder" :value.sync="dateTime" :name="name" style="display:none;">
    <datepicker :option="options" :time.sync="dateTime"></datepicker>
</template>