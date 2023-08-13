<?php

$html = <<< EOF
<style>
th,td {
  padding: 5px;
  border: 1px solid gray;
}
table {
  margin: 10px
  border-collapse:  collapse;
  table-layout: fixed; 
}
table>tr>th{
  background-color: lightgray;
}
.grid-two-block{
  display: grid;
  gap: 10px;
  grid-template-columns: 1fr 1fr;
}
</style>
<div class="grid-two-block">
  <section>
    <h2> CSS (used in 'the elephant in the room')</h2>
    <table>
      <tr>
        <th colspan="2">grid</th>
      </tr>
      <tr>
        <td>.grid-two-block</td>
        <td></td>
      </tr>
      <tr>
        <th colspan="2">button</th>
      </tr>
      <tr>
        <td>.button</td>
        <td></td>
      </tr>
      <tr>
        <th colspan="2">color</th>
      </tr>
      <tr>
        <td>.error</td>
        <td>border/bg color: aquamarine</td>
      </tr>
      <tr>
        <td>.primary</td>
        <td>border/bg color: tomato</td>
      </tr>
      <tr>
        <th colspan="2">text</th>
      </tr>
      <tr>
        <td>.text-center</td>
        <td></td>
      </tr>
      <tr>
        <td>.text-right</td>
        <td></td>
      </tr>
      <tr>
        <td>.text-left</td>
        <td></td>
      </tr>
      <tr>
        <th colspan="2">flex-box</th>
      </tr>
      <tr>
        <td>.justify-start</td>
        <td></td>
      </tr>
      <tr>
        <td>.justify-center</td>
        <td></td>
      </tr>
      <tr>
        <td>.justify-end</td>
        <td></td>
      </tr>
      <tr>
        <td>.justify-space-around</td>
        <td></td>
      </tr>
      <tr>
        <td>.align-center</td>
        <td></td>
      </tr>
      <tr>
        <th colspan="2">margin/padding</th>
      </tr>
      <tr>
        <td>.ma-*/.pa-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.mx-*/.px-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.mr-*/.pr-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.ml-*/.pl-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.my-*/.py-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.mt-*/.pt-*</td>
        <td>1-4(5px increments)</td>
      </tr>
      <tr>
        <td>.mb-*/.pb-*</td>
        <td>1-4(5px increments)</td>
      </tr>
    </table>
  </section>
  <br pagebreak="true"/>
  <section>
    <h2> JavaScript (used in 'the elephant in the room')</h2>
    <table>
      <tr>
        <th></th>
        <th></th>
      </tr>
      <tr>
        <td>Hamburger-menu</td>
        <td>The hamburger menu is usually represented by three horizontal lines stacked on top of each other, resembling a hamburger. When the user clicks or taps on the hamburger icon, it expands or slides out to reveal a navigation menu or a list of options.</td>
      </tr>
      <tr>
        <td>Tab</td>
        <td>A "tab" typically refers to a component or user interface element that allows users to switch between different sections or content within a web page or application. </td>
      </tr>
      <tr>
        <td>Modal</td>
        <td>A popup window that appears on top of the main content, blocking interaction with the rest of the page. It is created using HTML, CSS, and JavaScript, allowing you to display additional information or forms in a temporary overlay.</td>
      </tr>
    </table>
  </section>
</div>
EOF;


?>