<template>
<div>
  <kendo-scheduler :data-source="localDataSource" :date="date" :height="600" :timezone="'Etc/UTC'" @change="onChange" @edit="onEdit" @add="onAdd" @cancel="onCancel" @dataBound="onDataBound" @move="onMove" @navigate="onNavigate" @resize="onResize" @save="onSave">
    <kendo-scheduler-view :type="'day'"></kendo-scheduler-view>
    <kendo-scheduler-view :type="'workWeek'" :selected="true"></kendo-scheduler-view>
    <kendo-scheduler-view :type="'week'"></kendo-scheduler-view>
    <kendo-scheduler-view :type="'month'"></kendo-scheduler-view>
  </kendo-scheduler>
</div>
</template>

<script>
export default {
  data() {
    return {
      date: new Date(),
      localDataSource: [{
          id: 1,
          start: new Date("2013/6/6 08:00 AM"),
          end: new Date("2013/6/6 09:00 AM"),
          title: "Interview"
        },
        {
          id: 2,
          start: new Date("2013/6/6 08:00 AM"),
          end: new Date("2013/6/6 09:00 AM"),
          title: "Meeting"
        }
      ]
      // end local
    }
  },
  // end data
  methods: {
    onChange: function (ev) {
      console.log("Event :: change");
    },
    onEdit: function (ev) {
      console.log("Event :: edit");
    },
    onAdd: function (ev) {
      console.log("Event :: add");
    },
    onCancel: function (ev) {
      console.log("Event :: cancel");
    },
    onDataBound: function (ev) {
      console.log("Event :: dataBound");
    },
    onMove: function (ev) {
      console.log("Event :: move");
    },
    onNavigate: function (ev) {
      console.log("Event :: navigate");
    },
    onResize: function (ev) {
      console.log("Event :: resize");
    },
    onSave: function (ev) {
      console.log("Event :: save");
    }
  }
  //end method
}
</script>
