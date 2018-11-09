@extends('layout.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">

 <template v-if = "menu == 0">
    <h1>Contenido del Menu 0</h1>
 </template>     
 <template v-if = "menu == 1">
        <categoria></categoria>
 </template>     
     
 <template v-if = "menu == 2">
        <h1>Contenido del Menu 2</h1>
 </template>
 <template v-if = "menu == 3">
        <h1>Contenido del Menu 3</h1>
 </template> 
 <template v-if = "menu == 4">
        <h1>Contenido del Menu 4</h1>
 </template>
 <template v-if = "menu == 5">
        <h1>Contenido del Menu 5</h1>
 </template>
 <template v-if = "menu == 6">
        <h1>Contenido del Menu 1</h1>
 </template>
 <template v-if = "menu == 7">
        <h1>Contenido del Menu 1</h1>
 </template>
 <template v-if = "menu == 8">
        <h1>Contenido del Menu 1</h1>
 </template>
 <template v-if = "menu == 9">
        <h1>Contenido del Menu 1</h1>
 </template>
 <template v-if = "menu == 10">
        <h1>Contenido del Menu 1</h1>
 </template>
 <template v-if = "menu == 1000">
    <h1>Contenido del Menu 1</h1>
</template>
</div>
</div>
@endsection