@include("PDF/DeNumero_a_Letras")
<?php
 
$r=4;


$horaesac = getdate(); 
$fecha_hoy=date("d/m/Y");
$hora=date("H:i:s");


 $r=1;
 $rr=1;   


$resultado = DB::connection('cementerio')->table('HistoricoLiquidacion')
->leftjoin('FichaFuncionario', 'HistoricoLiquidacion.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
->leftjoin('Afp', 'FichaFuncionario.Id_Afp', '=', 'Afp.Id_Afp')
->leftjoin('Isapres', 'FichaFuncionario.Id_Isapre', '=', 'Isapres.Id_Isapre')
->leftjoin('FichaMunicipal', 'HistoricoLiquidacion.Id_Funcionario', '=', 'FichaMunicipal.Id_Funcionario')
->leftjoin('PlantasMunicipales', 'FichaMunicipal.Id_Planta', '=', 'PlantasMunicipales.Id_Planta')
->leftjoin('ModoDctos', 'FichaFuncionario.ModoPactadoAuge', '=', 'ModoDctos.Id_ModoDctos')
->leftjoin('HistoricoMovLiquidacion', 'FichaFuncionario.Id_Funcionario', '=', 'HistoricoMovLiquidacion.Id_Funcionario')
->leftjoin('Haberes', 'HistoricoMovLiquidacion.Id_HaberDcto', '=', 'Haberes.Id_Haber')
->where('FichaFuncionario.rut', '=', $rut)
->where('HistoricoLiquidacion.Mes', '=', $mes)
->where('HistoricoLiquidacion.Ano', '=', $ano)
->first();


$cont=0;

$resultado01 = DB::connection('cementerio')->table('HistoricoMovLiquidacion')
->leftjoin('Descuentos', 'HistoricoMovLiquidacion.Id_HaberDcto', '=', 'Descuentos.Id_Descuento')
->leftjoin('FichaFuncionario', 'HistoricoMovLiquidacion.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
->where('HistoricoMovLiquidacion.Tipo_HaberDcto', '=', 1)
->where('FichaFuncionario.Rut', '=', $rut)
->where('mes', '=',$mes)
->where('ano', '=',$ano)
->get();

@$i=0;

    foreach($resultado01 as $fila)
    {
        $Nombre[$i]=$fila->DctoDescripcion;
        $valor21[$i]=$fila->Valor_HaberDcto;
        $valor[$i]=number_format($valor21[$i],0,".",".");
        $i++;
    }



@$k=0;

$consulta02 = DB::connection('cementerio')->table('HistoricoMovLiquidacion')
->leftJoin('Haberes', 'HistoricoMovLiquidacion.Id_HaberDcto', '=', 'Haberes.Id_Haber')
->leftJoin('FichaFuncionario', 'HistoricoMovLiquidacion.Id_Funcionario', '=', 'FichaFuncionario.Id_Funcionario')
->where('HistoricoMovLiquidacion.Tipo_HaberDcto', '=', 0)
->where('FichaFuncionario.Rut', '=', $rut)
->where('mes', '=',$mes)
->where('ano', '=',$ano)
->get();

    foreach($consulta02 as $fila)
    {
        $NOmbre2[$k]=$fila->HaberDescripcion;
        $Valor22[$k]=$fila->Valor_HaberDcto;
        $Valor2[$k]=number_format($Valor22[$k],0,".",".");
        $k++;
    }


 // $id->Id_Funcionario


if (!empty($resultado->ModoDctos_Signo)) {
   

$ModoDctos_Signo=$resultado->ModoDctos_Signo;    
$Id_Planta=$resultado->Id_Planta;
$PlantaNombre=$resultado->PlantaNombre;  
$grado=$resultado->Id_Grado;
$jornada=$resultado->Jornada;
$codigo=$resultado->Id_Funcionario;
$rut_resibido=$resultado->Rut;   
$nombre_isapre=$resultado->IsapreNombre; 
$afpnombre=$resultado->AfpNombre;
$Id_Funcionario=$resultado->Id_Funcionario;
$DiasTrabajados=$resultado->DiasTrabajados;

$SueldoBase1=$resultado->SueldoBase;
$SueldoBase=number_format($SueldoBase1,0,",",".");

$Incremento1=$resultado->Incremento;
$Incremento=number_format($Incremento1,0,",",".");

$AsigMunicipal1=$resultado->AsigMunicipal;
$AsigMunicipal=number_format($AsigMunicipal1,0,",",".");

$AsigLey187171=$resultado->AsigLey18717;
$AsigLey18717=number_format($AsigLey187171,0,",",".");

$AsigLey185661=$resultado->AsigLey18566;
$AsigLey18566=number_format($AsigLey185661,0,",",".");

$AsigLey18675A101=$resultado->AsigLey18675A10;
$AsigLey18675A10=number_format($AsigLey18675A101,0,",",".");

$AsigLey18675A111=$resultado->AsigLey18675A11;
$AsigLey18675A11=number_format($AsigLey18675A111,0,",",".");


$AsigLey195291=$resultado->AsigLey19529;
$AsigLey19529=number_format($AsigLey195291,0,",",".");

$AsigLey194291=$resultado->AsigLey19429;
$AsigLey19429=number_format($AsigLey194291,0,",",".");

$AsigZona1=$resultado->AsigZona;
$AsigZona=number_format($AsigZona1,0,",",".");


$ComplementoZona1=$resultado->ComplementoZona;
$ComplementoZona=number_format($ComplementoZona1,0,",",".");

$AsigBienios1=$resultado->AsigBienios;
$AsigBienios=number_format($AsigBienios1,0,".",".");

$AsigBieniosZona1=$resultado->AsigBieniosZona;
$AsigBieniosZona=number_format($AsigBieniosZona1,0,".",".");

$ZonaBienios1=$resultado->ZonaBienios;
$ZonaBienios=number_format($ZonaBienios1,0,".",".");

$CompZonaBienios1=$resultado->CompZonaBienios;
$CompZonaBienios=number_format($CompZonaBienios1,0,".",".");

$AsigTrienios1=$resultado->AsigTrienios;
$AsigTrienios=number_format($AsigTrienios1,0,".",".");

$AsigEstimulo1=$resultado->AsigEstimulo;
$AsigEstimulo=number_format($AsigEstimulo1,0,".",".");

$AsigProfesional1=$resultado->AsigProfesional;
$AsigProfesional=number_format($AsigProfesional1,0,".",".");

$AsigResponsabilidad1=$resultado->AsigResponsabilidad;
$AsigResponsabilidad=number_format($AsigResponsabilidad1,0,".",".");

$AsigDLey3551A391=$resultado->AsigDLey3551A39;
$AsigDLey3551A39=number_format($AsigDLey3551A391,0,".",".");

$AsigLey19112_32A1=$resultado->AsigLey19112_32A;
$AsigLey19112_32A=number_format($AsigLey19112_32A1,0,".",".");

$AsigLey19112_20B1=$resultado->AsigLey19112_20B;
$AsigLey19112_20B=number_format($AsigLey19112_20B1,0,".",".");


$ImponibleDesahucio1=$resultado->ImponibleDesahucio;
$ImponibleDesahucio=number_format($ImponibleDesahucio1,0,".",".");

$NroHrsExtras251=$resultado->NroHrsExtras25;
$NroHrsExtras25=number_format($NroHrsExtras251,0,".",".");

$NroHrsExtras501=$resultado->NroHrsExtras50;
$NroHrsExtras50=number_format($NroHrsExtras501,0,".",".");

$MontoHrsExtras251=$resultado->MontoHrsExtras25;
$MontoHrsExtras25=number_format($MontoHrsExtras251,0,".",".");

$MontoHrsExtras501=$resultado->MontoHrsExtras50;
$MontoHrsExtras50=number_format($MontoHrsExtras501,0,".",".");

$IncrementoHrsExtras1=$resultado->IncrementoHrsExtras;
$IncrementoHrsExtras=number_format($IncrementoHrsExtras1,0,".",".");

$TotalImponible1=$resultado->TotalImponible;
$TotalImponible=number_format($TotalImponible1,0,".",".");

$NroCargaNormal1=$resultado->NroCargaNormal;
$NroCargaNormal=number_format($NroCargaNormal1,0,".",".");

$NroCargaInvalida1=$resultado->NroCargaInvalida;
$NroCargaInvalida=number_format($NroCargaInvalida1,0,".",".");

$NroCargaMaternal1=$resultado->NroCargaMaternal;
$NroCargaMaternal=number_format($NroCargaMaternal1,0,".",".");

$MontoCarga1=$resultado->MontoCarga;
$MontoCarga=number_format($MontoCarga1,0,".",".");

$MontoCargaMater1=$resultado->MontoCargaMater;
$MontoCargaMater=number_format($MontoCargaMater1,0,".",".");

$MontoRetroactivo1=$resultado->MontoRetroactivo;
$MontoRetroactivo=number_format($MontoRetroactivo1,0,".",".");

$MontoRetroMater1=$resultado->MontoRetroMater;
$MontoRetroMater=number_format($MontoRetroMater1,0,".",".");

$BaseImponible1=$resultado->BaseImponible;
$BaseImponible=number_format($BaseImponible1,0,".",".");

$MontoJubilacion1=$resultado->MontoJubilacion;
$MontoJubilacion=number_format($MontoJubilacion1,0,".",".");

$MontoDesahucio1=$resultado->MontoDesahucio;
$MontoDesahucio=number_format($MontoDesahucio1,0,".",".");

$MontoSalud1=$resultado->MontoSalud;
$MontoSalud=number_format($MontoSalud1,0,".",".");

$MontoAdicionalDos1=$resultado->MontoAdicionalDos;
$MontoAdicionalDos=number_format($MontoAdicionalDos1,0,".",".");

$MontoAdicionalFun1=$resultado->MontoAdicionalFun;
$MontoAdicionalFun=number_format($MontoAdicionalFun1,0,".",".");

$TotalTributable1=$resultado->TotalTributable;
$TotalTributable=number_format($TotalTributable1,0,".",".");

$BaseTributable1=$resultado->BaseTributable;
$BaseTributable=number_format($BaseTributable1,0,".",".");

$ImpuestoUnico1=$resultado->ImpuestoUnico;
$ImpuestoUnico=number_format($ImpuestoUnico1,0,".",".");

$TotalOtrosHaberes1=$resultado->TotalOtrosHaberes;
$TotalOtrosHaberes=number_format($TotalOtrosHaberes1,0,".",".");

$TotalHaberes1=$resultado->TotalHaberes;
$TotalHaberes=number_format($TotalHaberes1,0,".",".");

$TotalOtrosDctos1=$resultado->TotalOtrosDctos;
$TotalOtrosDctos=number_format($TotalOtrosDctos1,0,".",".");

$TotalDctosLegales1=$resultado->TotalDctosLegales;
$TotalDctosLegales=number_format($TotalDctosLegales1,0,".",".");

$TotalDctos1=$resultado->TotalDctos;
$TotalDctos=number_format($TotalDctos1,0,".",".");

$Liquido1=$resultado->Liquido;

$MontoAdicionalLegal1=$resultado->MontoAdicionalLegal;
$MontoAdicionalLegal=number_format($MontoAdicionalLegal1,0,".",".");

$BaseImponibleCesantia1=$resultado->BaseImponibleCesantia;
$BaseImponibleCesantia=number_format($BaseImponibleCesantia1,0,".",".");

$MontoCesantia1=$resultado->MontoCesantia;
$MontoCesantia=number_format($MontoCesantia1,0,".",".");

$MontoCesantiaEmpleador1=$resultado->MontoCesantiaEmpleador;
$MontoCesantiaEmpleador=number_format($MontoCesantiaEmpleador1,0,".",".");

$MontoCtaAhorroAfp1=$resultado->MontoCtaAhorroAfp;
$MontoCtaAhorraAfp=number_format($MontoCtaAhorroAfp1,0,".",".");

$MontoCotizVoluntaria1=$resultado->MontoCotizVoluntaria;
$MontoCotizVoluntariat=number_format($MontoCotizVoluntaria1,0,".",".");

$MontoAhorroPrevVoluntario1=$resultado->MontoAhorroPrevVoluntario;
$MontoAhorroPrevVoluntario=number_format($MontoAhorroPrevVoluntario1,0,".",".");

$MontoDepositoConvenido1=$resultado->MontoDepositoConvenido;
$MontoDepositoConvenido=number_format($MontoDepositoConvenido1,0,".",".");

$MontoDepositoConvenido1=$resultado->MontoDepositoConvenido;
$MontoDepositoConvenido=number_format($MontoDepositoConvenido1,0,".",".");

$MontoIndemnizacion1=$resultado->MontoIndemnizacion;
$MontoIndemnizacion=number_format($MontoIndemnizacion1,0,".",".");

$MontoTrabajoPesado1=$resultado->MontoTrabajoPesado;
$MontoTrabajoPesado=number_format($MontoTrabajoPesado1,0,".",".");

$MontoTrabajoPesadoEmpleador1=$resultado->MontoTrabajoPesadoEmpleador;
$MontoTrabajoPesadoEmpleador=number_format($MontoTrabajoPesadoEmpleador1,0,".",".");

$AportePatronal1=$resultado->AportePatronal;
$AportePatronal=number_format($AportePatronal1,0,".",".");

$Monto_SaludAuge1=$resultado->Monto_SaludAuge;
$Monto_SaludAuge=number_format($Monto_SaludAuge1,0,".",".");

$MontoCCAF1=$resultado->MontoCCAF;
$MontoCCAF=number_format($MontoCCAF1,0,".",".");

$MontoSinCCAF1=$resultado->MontoSinCCAF;
$MontoSinCCAF=number_format($MontoSinCCAF1,0,".",".");

$Rebaja_CotVol1=$resultado->Rebaja_CotVol;
$Rebaja_CotVol=number_format($Rebaja_CotVol1,0,".",".");

$Rebaja_APVI1=$resultado->Rebaja_APVI;
$Rebaja_APVI=number_format($Rebaja_APVI1,0,".",".");

$MontoAporteLey203051=$resultado->MontoAporteLey20305;
$MontoAporteLey20305=number_format($MontoAporteLey203051,0,".",".");

$MontoPension1=$resultado->MontoPension;
$MontoPension=number_format($MontoPension1,0,".",".");

$MontoSis1=$resultado->MontoSis;
$MontoSis=number_format($MontoSis1,0,".",".");

$MontoSisEmpleador1=$resultado->MontoSisEmpleador;
$MontoSisEmpleador=number_format($MontoSisEmpleador1,0,".",".");

$MontoCotizAfiliadoVol1=$resultado->MontoCotizAfiliadoVol;
$MontoCotizAfiliadoVol=number_format($MontoCotizAfiliadoVol1,0,".",".");

$MontoAhorroAfiliadoVol1=$resultado->MontoAhorroAfiliadoVol;
$MontoAhorroAfiliadoVol=number_format($MontoAhorroAfiliadoVol1,0,".",".");

$ModoPactadoReal1=$resultado->ModoPactadoReal;
$ModoPactadoReal=number_format($ModoPactadoReal1,0,".",".");

$ModoPactado=$resultado->ModoPactado;
$MontoAuge=$resultado->MontoAuge;

$MontoPactadoReal=$resultado->MontoPactadoReal;

$Id_HaberDcto=$resultado->Id_HaberDcto;

$Tipo_HaberDcto=$resultado->Tipo_HaberDcto;

$HaberDescripcion=$resultado->HaberDescripcion;
$Valor_HaberDcto=$resultado->Valor_HaberDcto;

$apellido=$resultado->Apellidos;

$nombres=$resultado->Nombres;

$fecha_inicio=$resultado->Fec_InicioContrato;

$fecha_final=$resultado->Fec_FinalContrato;

$fecha_bienios=$resultado->Fec_InicioBienios;

$trienios=$resultado->Trienios;

$numero_bienios=$resultado->NroBienios;

$numero_bienios_zona=$resultado->NroBieniosZona;
$z=0;

    if(!empty($AsigLey18717)){
    $arreglo[$z]=$AsigLey18717;
    $haberes[$z]="ASIG. LEY 18717";
    $z++;
    }
    if(!empty($AsigLey18566)){
    $arreglo[$z]=$AsigLey18566;
    $haberes[$z]="ASIG. LEY 18566";
    $z++;
    }

    if(!empty($AsigLey18675A10)){
    $arreglo[$z]=$AsigLey18675A10;
    $haberes[$z]="ASIG. LEY 18675 A10";
    $z++;
    }if(!empty($AsigLey19529)){
    $arreglo[$z]=$AsigLey19529;
    $haberes[$z]="ASIG. LEY 19529";
    $z++;
    }
    if(!empty($AsigLey18675A11)){
    $arreglo[$z]=$AsigLey18675A11;
    $haberes[$z]="ASIG. LEY 18675 A11";
    $z++;
    }
    if(!empty($AsigLey19429)){
    $arreglo[$z]=$AsigLey19429;
    $haberes[$z]="ASIG. LEY 19429";
    $z++;
    }if(!empty($AsigZona)){
    $arreglo[$z]=$AsigZona;
    $haberes[$z]="ASIG. ZONA";
    $z++;
    }
    if(!empty($ComplementoZona)){
    $arreglo[$z]=$ComplementoZona;
    $haberes[$z]="COMP. ZONA";
    $z++;
    }
    if(!empty($AsigBienios)){
    $arreglo[$z]=$AsigBienios;
    $haberes[$z]="BIENIOS S/ZONA";
    $z++;
    }
    if(!empty($CompZonaBienios)){
    $arreglo[$z]=$CompZonaBienios;
    $haberes[$z]="COMP. ZONA BIENIOS";
    $z++;
    }
    if(!empty($AsigTrienios)){
    $arreglo[$z]=$AsigTrienios;
    $haberes[$z]="ASIG. TRIENIOS";
    $z++;
    }
    if(!empty($AsigEstimulo)){
    $arreglo[$z]=$AsigEstimulo;
    $haberes[$z]="ASIG. ESTIMULO";
    $z++;
    }
    if(!empty($AsigProfesional)){
    $arreglo[$z]=$AsigProfesional;
    $haberes[$z]="ASIG. PROFESIONAL";
    $z++;
    }
    if(!empty($AsigResponsabilidad)){
    $arreglo[$z]=$AsigResponsabilidad;
    $haberes[$z]="ASIG. RESPONSABILIDAD";
    $z++;
    }if(!empty($AsigDLey3551A39)){
    $arreglo[$z]=$AsigDLey3551A39;
    $haberes[$z]="ASIG. LEY 3551 A39";
    $z++;
    }
    if(!empty($AsigLey19112_32A)){
    $arreglo[$z]=$AsigLey19112_32A;
    $haberes[$z]="ASIG. LEY 19112 32A";
    $z++;
    }
    if(!empty($AsigLey19112_20B)){
    $arreglo[$z]=$AsigLey19112_20B;
    $haberes[$z]="ASIG. LEY 19112 20B";
    $z++;
    }
    if(!empty($MontoHrsExtras25)){
    $arreglo[$z]=$MontoHrsExtras25;
    $haberes[$z]="MONTO HRS EXTRA 25%";
    $z++;
    }
    if(!empty($MontoHrsExtras50)){
    $arreglo[$z]=$MontoHrsExtras50;
    $haberes[$z]="MONTO HRS EXTRA 50%";
    $z++;
    }
    if(!empty($IncrementoHrsExtras)){
    $arreglo[$z]=$IncrementoHrsExtras;
    $haberes[$z]="INCREMENTO HRS EXTRAS";
    $z++;
    }
    
    
    if(!empty($NOmbre2[0])){
    $arreglo[$z]=$Valor2[0];
    $haberes[$z]=$NOmbre2[0];
    $z++;
    }
    if(!empty($NOmbre2[1])){
    $arreglo[$z]=$Valor2[1];
    $haberes[$z]=$NOmbre2[1];
    $z++;
    }
    if(!empty($NOmbre2[2])){
    $arreglo[$z]=$Valor2[2];
    $haberes[$z]=$NOmbre2[2];
    $z++;
    }
    if(!empty($NOmbre2[3])){
    $arreglo[$z]=$Valor2[3];
    $haberes[$z]=$NOmbre2[3];
    $z++;
    }
    if(!empty($NOmbre2[4])){
    $arreglo[$z]=$Valor2[4];
    $haberes[$z]=$NOmbre2[4];
    $z++;
    }
    if(!empty($NOmbre[5])){
    $arreglo[$z]=$Valor2[5];
    $haberes[$z]=$NOmbre2[5];
    $z++;
    }
    if(!empty($NOmbre2[6])){
    $arreglo[$z]=$Valor2[6];
    $haberes[$z]=$NOmbre2[6];
    $z++;
    }
    if(!empty($NOmbre2[7])){
    $arreglo[$z]=$Valor2[7];
    $haberes[$z]=$NOmbre2[7];
    $z++;
    }
    if(!empty($NOmbre2[8])){
    $arreglo[$z]=$Valor2[8];
    $haberes[$z]=$NOmbre2[8];
    $z++;
    }
    $r=0;
    if(!empty($Nombre[0])){
    $desc[$r]=$valor[0];
    $nombredesc[$r]=$Nombre[0];
    $r++;
    }if(!empty($Nombre[1])){
    $desc[$r]=$valor[1];
    $nombredesc[$r]=$Nombre[1];
    $r++;
    }if(!empty($Nombre[2])){
    $desc[$r]=$valor[2];
    $nombredesc[$r]=$Nombre[2];
    $r++;
    }if(!empty($Nombre[3])){
    $desc[$r]=$valor[3];
    $nombredesc[$r]=$Nombre[3];
    $r++;
    }if(!empty($Nombre[4])){
    $desc[$r]=$valor[4];
    $nombredesc[$r]=$Nombre[4];
    $r++;
    }if(!empty($Nombre[5])){
    $desc[$r]=$valor[5];
    $nombredesc[$r]=$Nombre[5];
    $r++;
    }if(!empty($Nombre[6])){
    $desc[$r]=$valor[6];
    $nombredesc[$r]=$Nombre[6];
    $r++;
    }if(!empty($Nombre[7])){
    $desc[$r]=$valor[7];
    $nombredesc[$r]=$Nombre[7];
    $r++;
    }if(!empty($Nombre[8])){
    $desc[$r]=$valor[8];
    $nombredesc[$r]=$Nombre[8];
    $r++;
    }if(!empty($Nombre[9])){
    $desc[$r]=$valor[9];
    $nombredesc[$r]=$Nombre[9];
    $r++;
    }if(!empty($Nombre[10])){
    $desc[$r]=$valor[10];
    $nombredesc[$r]=$Nombre[10]; 
    $r++;
    }if(!empty($Nombre[11])){
    $desc[$r]=$valor[11];
    $nombredesc[$r]=$Nombre[11];
    $r++;
    }if(!empty($Nombre[12])){
    $desc[$r]=$valor[12];
    $nombredesc[$r]=$Nombre[12];
    $r++;
    }if(!empty($Nombre[13])){
    $desc[$r]=$valor[13];
    $nombredesc[$r]=$Nombre[13];
    $r++; 
    }

    $resultado0 = DB::connection('cementerio')->table('Municipalidad')->first();
    $nombrehabilitador=$resultado0->HabilitadoRemuneraciones;

    $sumatoria=($MontoJubilacion+$MontoSalud);

    if($ModoPactado==0){$modo='%';}

    if($ModoPactado==1){$modo='UF';}

    if($ModoPactado==2){$modo='$';}

    if($ModoPactado==3){$modo='UF';}

    if($ModoPactado==4){$modo='UTM';}

    $MontoPactado=$resultado->MontoPactado;

    $Porcentaje_Afp=$resultado->Porcentaje_Afp;

    //cortando la variable\\
    $resto = substr ("$fecha_inicio", 0,10); 
    $resto2 = substr ("$fecha_bienios", 0,10);  

    if($mes==1){$meses="Enero";}
    if($mes==2){$meses='Febrero';}
    if($mes==3){$meses='Marzo';}
    if($mes==4){$meses='Abril';}
    if($mes==5){$meses='Mayo';}
    if($mes==6){$meses='Junio';}
    if($mes==7){$meses='Julio';}
    if($mes==8){$meses='Agosto';}
    if($mes==9){$meses='Septiembre';}
    if($mes==10){$meses='Octubre';}
    if($mes==11){$meses='Noviembre';}
    if($mes==12){$meses='Diciembre';}

    // @extends("PDF/DeNumero_a_Letras.php")
    $numerotexto= convertir($Liquido1); 

    $Liquido=number_format($Liquido1,0,".","."); 
?>
    <head>
        <meta charset="UTF-8">
        <title>Documento PDF</title>
        <style>
            h4{
            text-align: center;
            text-transform: uppercase;

            }
            #ContenidoIzqHead { 
              margin-left: 00px;
              width: 300px; 
              font-size: 10px;
            }
            #FechaPrincipalHead { 
                width: 150px; 
                font-size: 13px;
                margin-left: 160px;
            }
            #ContenidoDercHead { 
                margin-right: 0px;
                margin-top: 0px;
            }

            #TablaIzq { 
              width: 400px; 
              font-size: 11px;
              margin-right: 0px;
              margin-top: 0px;
            }
            #TablaDer { 
              width: 300px; 
              font-size: 11px;
              margin-left: 0px;
              margin-top: 0px;
            }

            #TablaIzqF { 
              width: 350px; 
              font-size: 11px;
              margin-right: 0px;
              margin-top: 0px;
            }
            #TablaDerF { 
              width: 350px; 
              font-size: 11px;
              margin-left: 0px;
              margin-top: 0px;
            }
   
        </style>
    </head>
    <table width="100%" border="0">
      <tr>
        <td>
          <div id="ContenidoIzqHead"> 
              I.MUNICIPALIDAD DE CURICO<br>
              DEPARTAMENTO DE RENUMERACIONES
          </div>
        </td>
          <td>
          <div id="FechaPrincipalHead">Fecha: <?php  echo $fecha_hoy;?></div>
        </td>
        <td>
          <div id="ContenidoDercHead">
            <img src="../public/Imagenes/logo.jpg" width="60" height="60"/>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <center>
            <h4 style="font-size: 14px;"><strong><u>LIQUIDACION DE REMUNERACION MES DE <?php echo $meses.'&nbsp;'.'DEL'.'&nbsp;'.$ano;?></u></strong></h4>
          </center>
        </td>
      </tr>
    <tr>
    </table>

      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td>
            <div>
            <div id="TablaIzq"> 
              <table width="100%" border="0" cellpadding="2" id="">
                <tr>
                  <td><strong>Nombre</strong></td>
                  <td><strong>: <?php echo $apellido.'&nbsp;'.$nombres; ?></strong></td>
                </tr>
                <tr>
                  <td>Grado</td>
                  <td>: <?php echo $grado; ?></td>
                </tr>
                <tr>
                  <td>Dias Trabajados</td>
                  <td>: <?php echo $DiasTrabajados; ?></td>
                </tr>
                <tr>
                  <td>N Horas Ext 25%</td>
                  <td>: <?php echo $NroHrsExtras25; ?></td>
                </tr>
                <tr>
                  <td>N Horas Ext 50%</td>
                  <td>: <?php echo $NroHrsExtras50; ?></td>
                </tr>
                <tr>
                  <td><strong>AFP</strong></td>
                  <td><strong>: <?php echo $afpnombre; ?></strong></td>
                </tr>
                <tr>
                  <td>% Dscto </td>
                  <td>: <?php echo $Porcentaje_Afp; ?></td>
                </tr>
                <tr>
                  <td>Fecha Ingreso </td>
                  <td>: <?php echo $resto; ?></td>
                </tr>
                <tr>
                  <td>Fecha Bienios</td>
                  <td>: <?php echo $resto2; ?></td>
                </tr>
                <tr>
                  <td><strong>Escalafon<strong></td>
                  <td><strong>: <?php echo $Id_Planta.'&nbsp;' .$PlantaNombre; ?></strong></td>
                </tr>
                <tr>
                  <td>Jornada</td>
                  <td>: <?php echo $jornada; ?></td>
                </tr>
              </table>
            </div>
          </td>
          <td>
            <div id="TablaDer"> 
              <table width="100%" border="0" cellpadding="2" id="">
                <tr>
                  <td>Codigo</td>
                  <td>: <?php echo $codigo; ?></td>
                </tr>
                <tr>
                  <td>R.U.T.</td>
                  <td>: <?php echo $rut_resibido; ?></td>
                </tr>
                <tr>
                  <td>Cargas N: <?php echo $NroCargaNormal; ?></td>
                  <td>I: <?php echo $NroCargaInvalida; ?></td>
                  <td>M: <?php echo $NroCargaMaternal; ?></td>
                </tr>
                <tr>
                  <td>Bienios S/Zona</td>
                  <td>: <?php echo $numero_bienios; ?></td>
                </tr>
                <tr>
                  <td>Bienios C/Zona</td>
                  <td>: <?php echo $numero_bienios_zona; ?></td>
                </tr>
                <tr>
                  <td>Trienio</td>
                  <td>: <?php echo $trienios; ?></td>
                </tr>
                <tr>
                  <td><strong>Isapre</strong></td>
                  <td><strong>: <?php echo $nombre_isapre; ?></strong></td>
                </tr>
                <tr>
                  <td>Modalidad</td>
                  <td>: <?php echo $modo; ?></td>
                </tr>
                <tr>
                  <td>Pactado</td>
                  <td>: <?php echo $MontoPactadoReal; ?></td>
                </tr>
                <tr>
                  <td>Modalidad Auge</td>
                  <td>: <?php echo $ModoDctos_Signo; ?></td>
                </tr>
                <tr>
                  <td>Pactado Auge</td>
                  <td>: <?php echo $MontoAuge; ?></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <hr>
      <table width="100%" border="0" cellpadding="2">
          <tr>
            <td style="font-size: 14px;">
              <center><strong><u>HABERES</u></strong></center> 
            </td>
            <td style="font-size: 14px;">  
              <center><strong><u>DESCUENTOS</u></strong></center> 
            </td>
         </tr>
      </table>
      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td>
            <div id="TablaIzq"> 
              <table width="100%" border="0" cellpadding="2" id="">
                <tr>
                  <td>SUELDO BASE</td>
                  <td>$<?php echo $SueldoBase; ?></td>
                </tr>
                <tr>
                  <td>INCREMENTO</td>
                   <td>$<?php echo $Incremento; ?></td>
                </tr>
                <tr>
                  <td>ASIG. MUNICIPAL</td>
                  <td>$<?php echo $AsigMunicipal; ?></td>
                </tr>
        
                <?php
                    $u=0;
                    while($u <=15):
                    
                      if(!empty($arreglo[$u]))
                        { ?>

                            <tr>
                              <td><?php echo $haberes[$u]; ?></td>
                              <td>$<?php echo $arreglo[$u]; ?></td>
                            </tr>
              
                <?php   }
                      $u++;
                    endwhile;

                ?>
              </table>
            </div>
          </td>
          <td>
            <div id="TablaDer"> 
              <table width="100%" border="0" cellpadding="2" id="">
                <tr>
                  <td><strong>COTIZACION OBLIGATORIA</strong></td>
                  <td><strong>$<?php echo $MontoJubilacion; ?></strong></td>
                </tr>
                <tr>
                  <td>SALUD</td>
                  <td>$<?php echo $MontoSalud; ?></td>
                </tr>
                <tr>
                  <td>TOTAL IMPOSICIONES </td>
                  <td>$<?php echo $sumatoria; ?></td>
                </tr>
                <tr>
                <?php 
            if($ImpuestoUnico !=0)
                { ?>
                  <td>IMPUESTO UNICO </td>
                  <td>$<?php echo $ImpuestoUnico; ?></td>
        <?php   }
            else
                { ?>
                    <td>IMPUESTO UNICO </td>
                    <td>$No Aplica</td>
        <?php   } ?>
                  
        <?php
            $u1=0;
            while($u1 <=15):
              if(!empty($nombredesc[$u1]))
                { ?>
                  <tr>
                    <td><?php echo $nombredesc[$u1]; ?></td>
                    <td>$<?php echo $desc[$u1]; ?></td>
                  </tr>
        <?php   }
                $u1++;
            endwhile;
        ?>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <hr>
      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td>
            <div id="TablaIzq"> 
              <table width="100%" border="0" cellpadding="2" id="">
                <tr>
                  <td><strong>TOTAL HABERES</strong></td>
                  <td><strong>$<?php echo $TotalHaberes; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>BASE IMPONIBLE</strong></td>
                  <td><strong>$<?php echo $BaseImponible; ?></strong></td></td>
                </tr>
                <tr>
                  <td><strong>BASE TRIBUTARIA</strong></td>
                  <td><strong>$<?php echo $BaseTributable; ?></strong></td>
                </tr>
              </table>
            </div>
          </td>
          <td>
            <div id="TablaDer"> 
              <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td><strong>TOTAL DESCUENTOS</strong></td>
                  <td><strong>$<?php echo $TotalDctos; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>LIQUIDO A PAGAR</strong></td>
                  <td><strong>$<?php echo $Liquido; ?></strong></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td><p style="font-size: 12px;"><strong>EN PALABRAS</strong></p></td>
          <td><p style="font-size: 12px;"><strong>:<?php echo $numerotexto; ?> PESOS.</strong></p></td>
        </tr>
      </table>
      <hr>
      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td>
            <div id="TablaIzq"> 
              <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td>(*)Aportes solo informativos de Cargo del Empleador </td>
                </tr>
              </table>
            </div>
          </td>
          <td>
            <div id="TablaDer"> 
              <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td><center>Dep. Convenio(*)</center></td>
                  <td><center>Trab. Pesado(*)</center></td>
                  <td><center>Sis.Empleado(*)</center></td>
                </tr>
                <tr>
                  <td><center>$0</center></td>
                  <td><center>$<?php echo $MontoTrabajoPesado; ?></center></td>
                  <td><center>$<?php echo $MontoSisEmpleador; ?></center></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellpadding="2">
        <tr>
          <td>
            <div id="TablaIzqF"> 
              <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td><center><hr></center></td>
                </tr>
                <tr>
                  <td><center><strong><?php echo $nombrehabilitador; ?></strong></center></td>
                </tr>
                <tr>
                  <td><center>FIRMA HABILITADO</center></td>
                </tr>
              </table>
            </div>
          </td>
          <td>
            <div id="TablaDerF"> 
              <table width="100%" border="0" cellpadding="2">
                <tr>
                  <td><center><hr></center></td>
                </tr>
                <tr>
                   <td><center><strong><?php echo $nombres.' '.$apellido ?></strong></center></td>
                </tr>
                <tr>
                  <td><center>FIRMA FUNCIONARIO</center></td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>




<?php

}
else{
    ?>

    <center><h3>Su Liquidación no se encuentra disponible, diríjase a dirección de gestión de personas.</h3></center>
<?php }
?>