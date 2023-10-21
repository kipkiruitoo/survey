<template>
    <div id="surveyVizPanel" />
  </template>
  
  <script>
  import 'survey-analytics/survey.analytics.min.css';
  import { Model } from 'survey-core';
  import { VisualizationPanel } from 'survey-analytics';
  

//   const props = defineProps();

  
  const vizPanelOptions = {
    allowHideQuestions: true,
    haveCommercialLicense: true,
  }
  
  export default {
    props: ['results', 'structure', 'surveyid', 'name'],
    name: 'survey-analytics',
    mounted() {
        
     const results = JSON.parse(this.results);
     console.log(this.structure);
     
      const survey = new Model(this.structure);
      const vizPanel = new VisualizationPanel(
        survey.getAllQuestions(),
        results,
        vizPanelOptions
      );
      vizPanel.showHeader = true;
      vizPanel.render(document.getElementById("surveyVizPanel"));
    }
  }
  </script>