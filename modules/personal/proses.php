<?php
session_start();
require_once "conexion.php";
$crud = new CRUD;
$objeto = new Objeto;

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  if ($_GET['act']=='reg_huella') {
    if (isset($_POST['btnsubmit'])) {

      $id = $_POST['id'];
      $objeto->fu_no1 = $_POST['fu_no1'];
      $objeto->fu_no2 = $_POST['fu_no2'];
      $objeto->fputemplate1 = $_POST['fputemplate1'];
      $objeto->fputemplate2 = $_POST['fputemplate2'];

      // echo "<pre>";
      // print_r ($objeto);
      // print_r ($_FILES);
      // echo "</pre>";

      $query = $crud->insertar_huella($id, $objeto);

      if ($query) {
          echo "<script>alert('Las huellas se agregaron correctamente !!'); window.close();</script>";
      }


    }
  } else {
    echo "usuer". $_SESSION['username'];
    echo "password".$_SESSION['password'];
   // echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
  }

} else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['Guardar'])) {

          $cp = $_POST['codigo_postal'];
          $colonia = $_POST['colonia'];
          $ciudad = $_POST['ciudad'];
          $estado = $_POST['estado'];

          $result = mysqli_fetch_assoc($crud->sepomex($cp,$colonia,$ciudad,$estado));

            $objeto->nombre = $_POST['nombre'];
            $objeto->edad = $_POST['edad'];
            $objeto->lugar_nacimiento = $_POST['lugar_nacimiento'];
            $objeto->fecha_nacimiento = $_POST['fecha_nacimiento'];
            $objeto->sexo = $_POST['sexo'];
            $objeto->domicilio = $_POST['domicilio'];
            $objeto->sepo = $result['id'];
            $objeto->fecha_cd = $_POST['fecha_cd'];
            $objeto->tel_cel = $_POST['tel_casa'];
            $objeto->tel_cel = $_POST['tel_cel'];
            $objeto->correo = $_POST['correo'];
            $objeto->vive_con = $_POST['vive_con'];
            $objeto->estado_civil = $_POST['estado_civil'];
            $objeto->banco = $_POST['banco'];
            $objeto->tarjeta = $_POST['t1'].$_POST['t2'].$_POST['t3'].$_POST['t4'].$_POST['t5'].$_POST['t6'].$_POST['t7'].$_POST['t8'].$_POST['t9'].$_POST['t10'].$_POST['t11'].$_POST['t12'].$_POST['t13'].$_POST['t14'].$_POST['t15'].$_POST['t16'];
            $objeto->curp = $_POST['c1'].$_POST['c2'].$_POST['c3'].$_POST['c4'].$_POST['c5'].$_POST['c6'].$_POST['c7'].$_POST['c8'].$_POST['c9'].$_POST['c10'].$_POST['c11'].$_POST['c12'].$_POST['c13'].$_POST['c14'].$_POST['c15'].$_POST['c16'].$_POST['c17'].$_POST['c18'];
            $objeto->cartilla = $_POST['cartilla'];
            $objeto->nss = $_POST['n1'].$_POST['n2'].$_POST['n3'].$_POST['n4'].$_POST['n5'].$_POST['n6'].$_POST['n7'].$_POST['n8'].$_POST['n9'].$_POST['n10'].$_POST['n11'];
            $objeto->rfc = $_POST['r1'].$_POST['r2'].$_POST['r3'].$_POST['r4'].$_POST['r5'].$_POST['r6'].$_POST['r7'].$_POST['r8'].$_POST['r9'].$_POST['r10'].$_POST['r11'].$_POST['r12'].$_POST['r13'];
            $objeto->ine = $_POST['i1'].$_POST['i2'].$_POST['i3'].$_POST['i4'].$_POST['i5'].$_POST['i6'].$_POST['i7'].$_POST['i8'].$_POST['i9'].$_POST['i10'].$_POST['i11'].$_POST['i12'].$_POST['i13'];
            $objeto->ine_vigencia = $_POST['ine_vigencia'];
            $objeto->infonavit = $_POST['infonavit'];
            $objeto->pasaporte = $_POST['pasaporte'];
            $objeto->afore = $_POST['afore'];
            $objeto->no_licencia = $_POST['no_licencia'];
            $objeto->tipo_licencia = $_POST['tipo_licencia'];
            $objeto->vigencia_licencia = $_POST['vigencia_licencia'];
            $objeto->nacionalidad = $_POST['nacionalidad'];
            $objeto->salud = $_POST['salud'];
            $objeto->drogas = $_POST['drogas'];
            $objeto->sangre = $_POST['sangre'];
            $objeto->diabetes = $_POST['diabetes'];
            $objeto->tratamiento_diabetes = $_POST['tratamiento_diabetes'];
            $objeto->alergia_medicamento = $_POST['alergia_medicamento'];
            $objeto->cirugias = $_POST['cirugias'];
            $objeto->cuantas_cirugias = $_POST['cuantas_cirugias'];
            $objeto->audicion = $_POST['audicion'];
            $objeto->fuma = $_POST['fuma'];
            $objeto->semana_fuma = $_POST['semana_fuma'];
            $objeto->asma = $_POST['asma'];
            $objeto->tratamiento_asma = $_POST['tratamiento_asma'];
            $objeto->epilepsia = $_POST['epilepsia'];
            $objeto->bronquitis = $_POST['bronquitis'];
            $objeto->tratamiento_bronquitis = $_POST['tratamiento_bronquitis'];
            $objeto->alteracion_vista = $_POST['alteracion_vista'];
            $objeto->otro = $_POST['otro'];
            $objeto->estudios = $_POST['estudios'];
            $objeto->titulo = $_POST['titulo'];
            $objeto->instituto = $_POST['instituto'];
            $objeto->software = $_POST['software'];
            $objeto->idiomas = $_POST['idiomas'];
            $objeto->periodo_1 = $_POST['periodo_1'];
            $objeto->periodo_2 = $_POST['periodo_2'];
            $objeto->periodo_3 = $_POST['periodo_3'];
            $objeto->empresa_1 = $_POST['empresa_1'];
            $objeto->empresa_2 = $_POST['empresa_2'];
            $objeto->empresa_3 = $_POST['empresa_3'];
            $objeto->telefono_1 = $_POST['telefono_1'];
            $objeto->telefono_2 = $_POST['telefono_2'];
            $objeto->telefono_3 = $_POST['telefono_3'];
            $objeto->puesto_1 = $_POST['puesto_1'];
            $objeto->puesto_2 = $_POST['puesto_2'];
            $objeto->puesto_3 = $_POST['puesto_3'];
            $objeto->separación_1 = $_POST['separacion_1'];
            $objeto->separación_2 = $_POST['separacion_2'];
            $objeto->separación_3 = $_POST['separacion_3'];
            $objeto->jefe_1 = $_POST['jefe_1'];
            $objeto->jefe_2 = $_POST['jefe_2'];
            $objeto->jefe_3 = $_POST['jefe_3'];
            $objeto->informes_1 = $_POST['informes_1'];
            $objeto->informes_2 = $_POST['informes_2'];
            $objeto->informes_3 = $_POST['informes_3'];
            $objeto->planta_1 = $_POST['planta_1'];
            $objeto->planta_2 = $_POST['planta_2'];
            $objeto->planta_3 = $_POST['planta_3'];
            $objeto->categoria_1 = $_POST['categoria_1'];
            $objeto->categoria_2 = $_POST['categoria_2'];
            $objeto->categoria_3 = $_POST['categoria_3'];
            $objeto->dc3_1 = $_POST['dc3_1'];
            $objeto->dc3_2 = $_POST['dc3_2'];
            $objeto->dc3_3 = $_POST['dc3_3'];
            $objeto->puesto_planta_1 = $_POST['puesto_planta_1'];
            $objeto->puesto_planta_2 = $_POST['puesto_planta_2'];
            $objeto->puesto_planta_3 = $_POST['puesto_planta_3'];
            $objeto->carnet_1 = $_POST['carnet_1'];
            $objeto->carnet_2 = $_POST['carnet_2'];
            $objeto->carnet_3 = $_POST['carnet_3'];
            $objeto->vigencia_1 = $_POST['vigencia_1'];
            $objeto->vigencia_2 = $_POST['vigencia_2'];
            $objeto->vigencia_3 = $_POST['vigencia_3'];
            $objeto->cursos_1 = $_POST['cursos_1'];
            $objeto->cursos_2 = $_POST['cursos_2'];
            $objeto->cursos_3 = $_POST['cursos_3'];
            $objeto->contacto_emergencia = $_POST['contacto_emergencia'];
            $objeto->parentesco = $_POST['parentesco'];
            $objeto->tel_emergencia = $_POST['tel_emergencia'];
            $objeto->papa_nombre = $_POST['papa_nombre'];
            $objeto->papa_status = $_POST['papa_status'];
            $objeto->papa_direccion = $_POST['papa_direccion'];
            $objeto->papa_tel_casa = $_POST['papa_tel_casa'];
            $objeto->papa_tel_movil = $_POST['papa_tel_movil'];
            $objeto->mama_nombre = $_POST['mama_nombre'];
            $objeto->mama_status = $_POST['mama_status'];
            $objeto->mama_direccion = $_POST['mama_direccion'];
            $objeto->mama_tel_casa = $_POST['mama_tel_casa'];
            $objeto->mama_tel_movil = $_POST['mama_tel_movil'];
            $objeto->esposo_nombre = $_POST['esposo_nombre'];
            $objeto->esposo_status = $_POST['esposo_status'];
            $objeto->esposo_direccion = $_POST['esposo_direccion'];
            $objeto->esposo_tel_casa = $_POST['esposo_tel_casa'];
            $objeto->esposo_tel_movil = $_POST['esposo_tel_movil'];
            $objeto->hijo_1_nombre = $_POST['hijo_1_nombre'];
            $objeto->hijo_1_edad = $_POST['hijo_1_edad'];
            $objeto->hijo_1_estudia = $_POST['hijo_1_estudia'];
            $objeto->hijo_1_estudios = $_POST['hijo_1_estudios'];
            $objeto->hijo_2_nombre = $_POST['hijo_2_nombre'];
            $objeto->hijo_2_edad = $_POST['hijo_2_edad'];
            $objeto->hijo_2_estudia = $_POST['hijo_2_estudia'];
            $objeto->hijo_2_estudios = $_POST['hijo_2_estudios'];
            $objeto->hijo_3_nombre = $_POST['hijo_3_nombre'];
            $objeto->hijo_3_edad = $_POST['hijo_3_edad'];
            $objeto->hijo_3_estudia = $_POST['hijo_3_estudia'];
            $objeto->hijo_3_estudios = $_POST['hijo_3_estudios'];
            $objeto->beneficiario_1_nombre = $_POST['beneficiario_1_nombre'];
            $objeto->beneficiario_1_domicilio = $_POST['beneficiario_1_domicilio'];
            $objeto->beneficiario_1_parentesco = $_POST['beneficiario_1_parentesco'];
            $objeto->beneficiario_1_nacimiento = $_POST['beneficiario_1_nacimiento'];
            $objeto->beneficiario_1_porcentaje = $_POST['beneficiario_1_porcentaje'];
            $objeto->beneficiario_2_nombre = $_POST['beneficiario_2_nombre'];
            $objeto->beneficiario_2_domicilio = $_POST['beneficiario_2_domicilio'];
            $objeto->beneficiario_2_parentesco = $_POST['beneficiario_2_parentesco'];
            $objeto->beneficiario_2_nacimiento = $_POST['beneficiario_2_nacimiento'];
            $objeto->beneficiario_2_porcentaje = $_POST['beneficiario_2_porcentaje'];
            $objeto->referencia_1_nombre = $_POST['referencia_1_nombre'];
            $objeto->referencia_1_domicilio = $_POST['referencia_1_domicilio'];
            $objeto->referencia_1_tel_casa = $_POST['referencia_1_tel_casa'];
            $objeto->referencia_1_tel_movil = $_POST['referencia_1_tel_movil'];
            $objeto->referencia_2_nombre = $_POST['referencia_2_nombre'];
            $objeto->referencia_2_domicilio = $_POST['referencia_2_domicilio'];
            $objeto->referencia_2_tel_casa = $_POST['referencia_2_tel_casa'];
            $objeto->referencia_2_tel_movil = $_POST['referencia_2_tel_movil'];
            $objeto->referencia_3_nombre = $_POST['referencia_3_nombre'];
            $objeto->referencia_3_domicilio = $_POST['referencia_3_domicilio'];
            $objeto->referencia_3_tel_casa = $_POST['referencia_3_tel_casa'];
            $objeto->referencia_3_tel_movil = $_POST['referencia_3_tel_movil'];
            $objeto->estatus = "Inactivo";
            $objeto->calificacion = 0;
            $objeto->departamento = $_POST['departamento'];
            $objeto->ocupacion = $_POST['ocupacion'];
            $objeto->categoria = $_POST['categoria'];
            $objeto->observaciones = "";
            $objeto->contrato = "";

            // Documento Acta de nacimiento si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['dacta']['name'])) {
                $dacta = "1";
                $file = explode(".", $_FILES['dacta']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['dacta']['tmp_name'], "documentos/".$objeto->rfc."_dacta.".$extension)){
                    $objeto->dacta = $objeto->rfc."_dacta.".$extension;
                }else {
                  $dacta = "0";
                  $objeto->dacta ="";
                }
            } else {
                $dacta = "0";
                $objeto->dacta = "";
            }

            //Documento INE si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['dife']['name'])) {
                $dife = "1";
                $file = explode(".", $_FILES['dife']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['dife']['tmp_name'], "documentos/".$objeto->rfc."_dife.".$extension)){
                    $objeto->dine = $objeto->rfc."_dife.".$extension;
                }else {
                  $dife = "0";
                  $objeto->dine ="";
                }
            } else {
                $dife = "0";
                $objeto->dine = "";
            }

            //Documento Comprobante de Domicilio si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['dcd']['name'])) {
                $dcd = "1";
                $file = explode(".", $_FILES['dcd']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['dcd']['tmp_name'], "documentos/".$objeto->rfc."_dcd.".$extension)){
                    $objeto->dcd = $objeto->rfc."_dcd.".$extension;
                }else {
                  $dcd = "0";
                  $objeto->dcd ="";
                }
            } else {
                $dcd = "0";
                $objeto->dcd = "";
            }

            //Documento CURP si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['dcurp']['name'])) {
                $dcurp = "1";
                $file = explode(".", $_FILES['dcurp']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['dcurp']['tmp_name'], "documentos/".$objeto->rfc."_dcurp.".$extension)){
                    $objeto->dcurp = $objeto->rfc."_dcurp.".$extension;
                }else {
                  $dcurp = "0";
                  $objeto->dcurp ="";
                }
            } else {
                $dcurp = "0";
                $objeto->dcurp = "";
            }

            //Documento RFC si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['drfc']['name'])) {
                $drfc = "1";
                $file = explode(".", $_FILES['drfc']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['drfc']['tmp_name'], "documentos/".$objeto->rfc."_drfc.".$extension)){
                    $objeto->drfc = $objeto->rfc."_drfc.".$extension;
                }else {
                  $drfc = "0";
                  $objeto->drfc ="";
                }
            } else {
                $drfc = "0";
                $objeto->drfc = "";
            }

            //Documento NSS si se agrego la foto se guarda en la carpeta documentos
            if (isset($_FILES['dns']['name'])) {
                $dns = "1";
                $file = explode(".", $_FILES['dns']['name']);
                $extension = array_pop($file);

                if (move_uploaded_file($_FILES['dns']['tmp_name'], "documentos/".$objeto->rfc."_dns.".$extension)){
                    $objeto->dns = $objeto->rfc."_dns.".$extension;
                }else {
                  $dns = "0";
                  $objeto->dns ="";
                }
            } else {
                $dns = "0";
                $objeto->dns ="";
            }
            //Documentos verificados
            $objeto->documentos = "$dacta $dife $dcd $dcurp $drfc $dns";

            //Foto 1 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
            if (!empty($_FILES['foto_1']['name'])) {

              $file = explode(".", $_FILES['foto_1']['name']);
              $extension = array_pop($file);

                if (move_uploaded_file($_FILES['foto_1']['tmp_name'], "fotos/".$objeto->rfc."_1.".$extension)){
                    $objeto->foto_1 = $objeto->rfc."_1.".$extension;
                }else {
                  $objeto->foto_1 = "user-default.png";
                }
            }else {
              $objeto->foto_1 = "user-default.png";
            }

            //Foto 2 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
            if (!empty($_FILES['foto_2']['name'])) {

              $file = explode(".", $_FILES['foto_2']['name']);
              $extension = array_pop($file);

                if (move_uploaded_file($_FILES['foto_2']['tmp_name'], "fotos/".$objeto->rfc."_2.".$extension)){
                    $objeto->foto_2 = $objeto->rfc."_2.".$extension;
                }else {
                  $objeto->foto_2 = "user-default.png";
                }
            }else {
              $objeto->foto_2 = "user-default.png";
            }

            //Foto 3 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
            if (!empty($_FILES['foto_3']['name'])) {

              $file = explode(".", $_FILES['foto_3']['name']);
              $extension = array_pop($file);

                if (move_uploaded_file($_FILES['foto_3']['tmp_name'], "fotos/".$objeto->rfc."_3.".$extension)){
                    $objeto->foto_3 = $objeto->rfc."_3.".$extension;
                }else {
                  $objeto->foto_3 = "user-default.png";
                }
            }else {
              $objeto->foto_3 = "user-default.png";
            }

            $objeto->edito = $_SESSION['username'];

            //Verificar que los datos se estan enviando correctamente
            // echo "<pre>";
            // print_r ($objeto);
            // print_r ($_FILES);
            // echo "</pre>";

            //insertar personal
            $query = $crud->insertar_Persona($objeto);

            if ($query) {
                echo "<script>location.href='../../main.php?module=Inicio_Personal&alert=1';</script>";
            }
        }
    } elseif ($_GET['act']=='update') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id'])) {

              $cp = $_POST['codigo_postal'];
              $colonia = $_POST['colonia'];
              $ciudad = $_POST['ciudad'];
              $estado = $_POST['estado'];

              $result = mysqli_fetch_assoc($crud->sepomex($cp,$colonia,$ciudad,$estado));

              $objeto->id = $_POST['id'];
              $objeto->nombre = $_POST['nombre'];
              $objeto->edad = $_POST['edad'];
              $objeto->lugar_nacimiento = $_POST['lugar_nacimiento'];
              $objeto->fecha_nacimiento = $_POST['fecha_nacimiento'];
              if(isset($_POST['sexo'])){ $objeto->sexo = $_POST['sexo']; }else{$objeto->sexo = ''; }
              if(isset($_POST['fecha_cd'])){ $objeto->fecha_cd = $_POST['fecha_cd']; }else{$objeto->fecha_cd = ''; }

              $objeto->domicilio = $_POST['domicilio'];
              $objeto->sepo = $result['id'];
              $objeto->tel_casa = $_POST['tel_casa'];
              $objeto->tel_cel = $_POST['tel_cel'];
              $objeto->correo = $_POST['correo'];
              if(isset($_POST['vive_con'])){ $objeto->vive_con = $_POST['vive_con']; }else{$objeto->vive_con = ''; }
              if(isset($_POST['estado_civil'])){ $objeto->estado_civil = $_POST['estado_civil']; }else{$objeto->estado_civil = ''; }




              $objeto->banco = $_POST['banco'];
              $objeto->tarjeta = $_POST['t1'].$_POST['t2'].$_POST['t3'].$_POST['t4'].$_POST['t5'].$_POST['t6'].$_POST['t7'].$_POST['t8'].$_POST['t9'].$_POST['t10'].$_POST['t11'].$_POST['t12'].$_POST['t13'].$_POST['t14'].$_POST['t15'].$_POST['t16'];
              $objeto->curp = $_POST['c1'].$_POST['c2'].$_POST['c3'].$_POST['c4'].$_POST['c5'].$_POST['c6'].$_POST['c7'].$_POST['c8'].$_POST['c9'].$_POST['c10'].$_POST['c11'].$_POST['c12'].$_POST['c13'].$_POST['c14'].$_POST['c15'].$_POST['c16'].$_POST['c17'].$_POST['c18'];
              $objeto->cartilla = $_POST['cartilla'];
              $objeto->nss = $_POST['n1'].$_POST['n2'].$_POST['n3'].$_POST['n4'].$_POST['n5'].$_POST['n6'].$_POST['n7'].$_POST['n8'].$_POST['n9'].$_POST['n10'].$_POST['n11'];
              $objeto->rfc = $_POST['r1'].$_POST['r2'].$_POST['r3'].$_POST['r4'].$_POST['r5'].$_POST['r6'].$_POST['r7'].$_POST['r8'].$_POST['r9'].$_POST['r10'].$_POST['r11'].$_POST['r12'].$_POST['r13'];
              $objeto->ine = $_POST['i1'].$_POST['i2'].$_POST['i3'].$_POST['i4'].$_POST['i5'].$_POST['i6'].$_POST['i7'].$_POST['i8'].$_POST['i9'].$_POST['i10'].$_POST['i11'].$_POST['i12'].$_POST['i13'];
              $objeto->ine_vigencia = $_POST['ine_vigencia'];
              $objeto->infonavit = $_POST['infonavit'];
              $objeto->pasaporte = $_POST['pasaporte'];
              $objeto->afore = $_POST['afore'];
              $objeto->no_licencia = $_POST['no_licencia'];
              $objeto->tipo_licencia = $_POST['tipo_licencia'];
              $objeto->vigencia_licencia = $_POST['vigencia_licencia'];
              $objeto->nacionalidad = $_POST['nacionalidad'];


              if(isset($_POST['salud'])){ $objeto->salud = $_POST['salud']; }else{$objeto->salud = ''; }
              if(isset($_POST['drogas'])){ $objeto->drogas = $_POST['drogas'];}else{$objeto->drogas = ''; }
              if(isset($_POST['sangre'])){ $objeto->sangre = $_POST['sangre'];}else{$objeto->sangre = ''; }
              if(isset($_POST['diabetes'])){ $objeto->diabetes = $_POST['diabetes'];}else{$objeto->diabetes = ''; }
              if(isset($_POST['tratamiento_diabetes'])){ $objeto->tratamiento_diabetes = $_POST['tratamiento_diabetes'];}else{$objeto->tratamiento_diabetes = ''; }
              if(isset($_POST['cirugias'])){ $objeto->cirugias = $_POST['cirugias'];}else{$objeto->cirugias = ''; }
              if(isset($_POST['salud'])){ $objeto->salud = $_POST['salud'];}else{$objeto->salud = ''; }
              if(isset($_POST['salud'])){ $objeto->salud = $_POST['salud'];}else{$objeto->salud = ''; }
              if(isset($_POST['salud'])){ $objeto->salud = $_POST['salud'];}else{$objeto->salud = ''; }
              if(isset($_POST['salud'])){ $objeto->salud = $_POST['salud'];}else{$objeto->salud = ''; }


              $objeto->alergia_medicamento = $_POST['alergia_medicamento'];
              if(isset($_POST['cirugias'])){ $objeto->cirugias = $_POST['cirugias']; }else{$objeto->cirugias = ''; }
              $objeto->cuantas_cirugias = $_POST['cuantas_cirugias'];
              if(isset($_POST['audicion'])){ $objeto->audicion = $_POST['audicion'];}else{$objeto->audicion = ''; }
              if(isset($_POST['fuma'])){ $objeto->fuma = $_POST['fuma'];}else{$objeto->fuma = ''; }
              if(isset($_POST['asma'])){ $objeto->asma = $_POST['asma']; }else{$objeto->asma = ''; }
              if(isset($_POST['tratamiento_asma'])){ $objeto->tratamiento_asma = $_POST['tratamiento_asma']; }else{$objeto->tratamiento_asma = ''; }
              if(isset($_POST['epilepsia'])){ $objeto->epilepsia = $_POST['epilepsia']; }else{$objeto->epilepsia = ''; }
              if(isset($_POST['bronquitis'])){ $objeto->bronquitis = $_POST['bronquitis']; }else{$objeto->bronquitis = ''; }

              $objeto->semana_fuma = $_POST['semana_fuma'];
              if(isset($_POST['tratamiento_bronquitis'])){ $objeto->tratamiento_bronquitis = $_POST['tratamiento_bronquitis']; }else{$objeto->tratamiento_bronquitis = ''; }
             if(isset($_POST['alteracion_vista'])){ $objeto->alteracion_vista = $_POST['alteracion_vista']; }else{$objeto->alteracion_vista = ''; }
              $objeto->otro = $_POST['otro'];
              $objeto->estudios = $_POST['estudios'];
              if(isset($_POST['titulo'])){ $objeto->titulo = $_POST['titulo']; }else{$objeto->titulo = ''; }


              $objeto->instituto = $_POST['instituto'];
              $objeto->software = $_POST['software'];
              $objeto->idiomas = $_POST['idiomas'];
              $objeto->periodo_1 = $_POST['periodo_1'];
              $objeto->periodo_2 = $_POST['periodo_2'];
              $objeto->periodo_3 = $_POST['periodo_3'];
              $objeto->empresa_1 = $_POST['empresa_1'];
              $objeto->empresa_2 = $_POST['empresa_2'];
              $objeto->empresa_3 = $_POST['empresa_3'];
              $objeto->telefono_1 = $_POST['telefono_1'];
              $objeto->telefono_2 = $_POST['telefono_2'];
              $objeto->telefono_3 = $_POST['telefono_3'];
              $objeto->puesto_1 = $_POST['puesto_1'];
              $objeto->puesto_2 = $_POST['puesto_2'];
              $objeto->puesto_3 = $_POST['puesto_3'];
              $objeto->separación_1 = $_POST['separacion_1'];
              $objeto->separación_2 = $_POST['separacion_2'];
              $objeto->separación_3 = $_POST['separacion_3'];
              $objeto->jefe_1 = $_POST['jefe_1'];
              $objeto->jefe_2 = $_POST['jefe_2'];
              $objeto->jefe_3 = $_POST['jefe_3'];
              if(isset($_POST['informes_1'])){ $objeto->informes_1 = $_POST['informes_1']; }else{$objeto->informes_1 = ''; }
              if(isset($_POST['informes_2'])){ $objeto->informes_2 = $_POST['informes_2']; }else{$objeto->informes_2 = ''; }
              if(isset($_POST['informes_3'])){ $objeto->informes_3 = $_POST['informes_3']; }else{$objeto->informes_3 = ''; }

              $objeto->planta_1 = $_POST['planta_1'];
              $objeto->planta_2 = $_POST['planta_2'];
              $objeto->planta_3 = $_POST['planta_3'];
              $objeto->categoria_1 = $_POST['categoria_1'];
              $objeto->categoria_2 = $_POST['categoria_2'];
              $objeto->categoria_3 = $_POST['categoria_3'];
              if(isset($_POST['dc3_1'])){ $objeto->dc3_1 = $_POST['dc3_1']; }else{$objeto->dc3_1 = ''; }
              if(isset($_POST['dc3_2'])){ $objeto->dc3_2 = $_POST['dc3_2']; }else{$objeto->dc3_2 = ''; }
              if(isset($_POST['dc3_3'])){ $objeto->dc3_3 = $_POST['dc3_3']; }else{$objeto->dc3_3 = ''; }

              $objeto->puesto_planta_1 = $_POST['puesto_planta_1'];
              $objeto->puesto_planta_2 = $_POST['puesto_planta_2'];
              $objeto->puesto_planta_3 = $_POST['puesto_planta_3'];
              $objeto->carnet_1 = $_POST['carnet_1'];
              $objeto->carnet_2 = $_POST['carnet_2'];
              $objeto->carnet_3 = $_POST['carnet_3'];
              $objeto->vigencia_1 = $_POST['vigencia_1'];
              $objeto->vigencia_2 = $_POST['vigencia_2'];
              $objeto->vigencia_3 = $_POST['vigencia_3'];
              $objeto->cursos_1 = $_POST['cursos_1'];
              $objeto->cursos_2 = $_POST['cursos_2'];
              $objeto->cursos_3 = $_POST['cursos_3'];
              $objeto->contacto_emergencia = $_POST['contacto_emergencia'];
              $objeto->parentesco = $_POST['parentesco'];
              $objeto->tel_emergencia = $_POST['tel_emergencia'];
              $objeto->papa_nombre = $_POST['papa_nombre'];
              $objeto->papa_status = $_POST['papa_status'];
              $objeto->papa_direccion = $_POST['papa_direccion'];
              $objeto->papa_tel_casa = $_POST['papa_tel_casa'];
              $objeto->papa_tel_movil = $_POST['papa_tel_movil'];
              $objeto->mama_nombre = $_POST['mama_nombre'];
              $objeto->mama_status = $_POST['mama_status'];
              $objeto->mama_direccion = $_POST['mama_direccion'];
              $objeto->mama_tel_casa = $_POST['mama_tel_casa'];
              $objeto->mama_tel_movil = $_POST['mama_tel_movil'];
              $objeto->esposo_nombre = $_POST['esposo_nombre'];
              $objeto->esposo_status = $_POST['esposo_status'];
              $objeto->esposo_direccion = $_POST['esposo_direccion'];
              $objeto->esposo_tel_casa = $_POST['esposo_tel_casa'];
              $objeto->esposo_tel_movil = $_POST['esposo_tel_movil'];
              $objeto->hijo_1_nombre = $_POST['hijo_1_nombre'];
              $objeto->hijo_1_edad = $_POST['hijo_1_edad'];
              $objeto->hijo_1_estudia = $_POST['hijo_1_estudia'];
              $objeto->hijo_1_estudios = $_POST['hijo_1_estudios'];
              $objeto->hijo_2_nombre = $_POST['hijo_2_nombre'];
              $objeto->hijo_2_edad = $_POST['hijo_2_edad'];
              $objeto->hijo_2_estudia = $_POST['hijo_2_estudia'];
              $objeto->hijo_2_estudios = $_POST['hijo_2_estudios'];
              $objeto->hijo_3_nombre = $_POST['hijo_3_nombre'];
              $objeto->hijo_3_edad = $_POST['hijo_3_edad'];
              $objeto->hijo_3_estudia = $_POST['hijo_3_estudia'];
              $objeto->hijo_3_estudios = $_POST['hijo_3_estudios'];
              $objeto->beneficiario_1_nombre = $_POST['beneficiario_1_nombre'];
              $objeto->beneficiario_1_domicilio = $_POST['beneficiario_1_domicilio'];
              $objeto->beneficiario_1_parentesco = $_POST['beneficiario_1_parentesco'];
              $objeto->beneficiario_1_nacimiento = $_POST['beneficiario_1_nacimiento'];
              $objeto->beneficiario_1_porcentaje = $_POST['beneficiario_1_porcentaje'];
              $objeto->beneficiario_2_nombre = $_POST['beneficiario_2_nombre'];
              $objeto->beneficiario_2_domicilio = $_POST['beneficiario_2_domicilio'];
              $objeto->beneficiario_2_parentesco = $_POST['beneficiario_2_parentesco'];
              $objeto->beneficiario_2_nacimiento = $_POST['beneficiario_2_nacimiento'];
              $objeto->beneficiario_2_porcentaje = $_POST['beneficiario_2_porcentaje'];
              $objeto->referencia_1_nombre = $_POST['referencia_1_nombre'];
              $objeto->referencia_1_domicilio = $_POST['referencia_1_domicilio'];
              $objeto->referencia_1_tel_casa = $_POST['referencia_1_tel_casa'];
              $objeto->referencia_1_tel_movil = $_POST['referencia_1_tel_movil'];
              $objeto->referencia_2_nombre = $_POST['referencia_2_nombre'];
              $objeto->referencia_2_domicilio = $_POST['referencia_2_domicilio'];
              $objeto->referencia_2_tel_casa = $_POST['referencia_2_tel_casa'];
              $objeto->referencia_2_tel_movil = $_POST['referencia_2_tel_movil'];
              $objeto->referencia_3_nombre = $_POST['referencia_3_nombre'];
              $objeto->referencia_3_domicilio = $_POST['referencia_3_domicilio'];
              $objeto->referencia_3_tel_casa = $_POST['referencia_3_tel_casa'];
              $objeto->referencia_3_tel_movil = $_POST['referencia_3_tel_movil'];
              $objeto->estatus = $_POST['estatus'];
              $objeto->calificacion = $_POST['calificacion'];
              $objeto->departamento = $_POST['departamento'];
              $objeto->ocupacion = $_POST['ocupacion'];
              $objeto->categoria = $_POST['categoria'];
              $objeto->observaciones = $_POST['observaciones'];
              $objeto->contrato = $_POST['contrato'];

              //Documento Acta si se agrego la foto se guarda en la carpeta documentos
             if(isset($_POST['dacta2'])){ $dacta = $_POST['dacta2']; }else{$dacta = ''; }

              if ($dacta == "") {
                if (isset($_FILES['dacta2']['name'])) {
                    $dacta = "1";
                    $file = explode(".", $_FILES['dacta2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dacta2']['tmp_name'], "documentos/".$objeto->rfc."_dacta.".$extension)){
                        $objeto->dacta = $objeto->rfc."_dacta.".$extension;

                    }else {
                      $dacta = "0";
                      $objeto->dacta =$_POST['d_1'];

                    }
                } else {
                    $dacta = "0";
                    $objeto->dacta="";

                }
              }else{
                if (isset($_FILES['dacta2']['name'])) {
                    $dacta = "1";
                    $file = explode(".", $_FILES['dacta2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dacta2']['tmp_name'], "documentos/".$objeto->rfc."_dacta.".$extension)){
                        $objeto->dacta = $objeto->rfc."_dacta.".$extension;

                    }else {
                      $dacta = "0";
                      $objeto->dacta ="";

                    }
                } else {
                  $dacta = "1";
                  $objeto->dacta = $_POST['d_1'];

                }
              }

              //Documento INE si se agrego la foto se guarda en la carpeta documentos
                if(isset($_POST['dife2'])){ $dine = $_POST['dife2']; }else{$dine = ''; }

              if ($dine == "") {
                if (isset($_FILES['dife2']['name'])) {
                    $dine = "1";
                    $file = explode(".", $_FILES['dife2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dife2']['tmp_name'], "documentos/".$objeto->rfc."_dine.".$extension)){
                        $objeto->dine = $objeto->rfc."_dine.".$extension;
                    }else {
                      $dine = "0";
                     $objeto->dine = $_POST['d_2'];
                    }
                } else {
                    $dine = "0";
                    $objeto->dine ="";
                }
              }else{
                if (isset($_FILES['dife2']['name'])) {
                    $dine = "1";
                    $file = explode(".", $_FILES['dife2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dife2']['tmp_name'], "documentos/".$objeto->rfc."_dine.".$extension)){
                        $objeto->dine = $objeto->rfc."_dine.".$extension;
                    }else {
                      $dine = "0";
                      $objeto->dine ="";
                    }
                } else {
                  $dine = "1";
                  $objeto->dine = $_POST['d_2'];
                }
              }

              //Documento Comprobante de Domicilio si se agrego la foto se guarda en la carpeta documentos
                if(isset($_POST['dcd2'])){ $dcd = $_POST['dcd2']; }else{$dcd = ''; }

              if ($dcd == "") {
                if (isset($_FILES['dcd2']['name'])) {
                    $dcd = "1";
                    $file = explode(".", $_FILES['dcd2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dcd2']['tmp_name'], "documentos/".$objeto->rfc."_dcd.".$extension)){
                        $objeto->dcd = $objeto->rfc."_dcd.".$extension;
                    }else {
                      $dcd = "0";
                       $objeto->dcd = $_POST['d_3'];
                    }
                } else {
                    $dcd = "0";
                    $objeto->dcd ="";
                }
              }else{
                if (isset($_FILES['dcd2']['name'])) {
                    $dcd = "1";
                    $file = explode(".", $_FILES['dcd2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dcd2']['tmp_name'], "documentos/".$objeto->rfc."_dcd.".$extension)){
                        $objeto->dcd = $objeto->rfc."_dcd.".$extension;
                    }else {
                      $dcd = "0";
                      $objeto->dcd ="";
                    }
                } else {
                  $dcd = "1";
                  $objeto->dcd = $_POST['d_3'];
                }
              }

              //Documento Curp si se agrego la foto se guarda en la carpeta documentos
                if(isset($_POST['dcurp2'])){ $dcurp = $_POST['dcurp2']; }else{$dcurp = ''; }

              if ($dcurp == "") {
                if (isset($_FILES['dcurp2']['name'])) {
                    $dcurp = "1";
                    $file = explode(".", $_FILES['dcurp2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dcurp2']['tmp_name'], "documentos/".$objeto->rfc."_dcurp.".$extension)){
                        $objeto->dcurp = $objeto->rfc."_dcurp.".$extension;
                    }else {
                      $dcurp = "0";
                        $objeto->dcurp = $_POST['d_4'];
                    }
                } else {
                    $dcurp = "0";
                    $objeto->dcurp ="";
                }
              }else{
                if (isset($_FILES['dcurp2']['name'])) {
                    $dcurp = "1";
                    $file = explode(".", $_FILES['dcurp2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dcurp2']['tmp_name'], "documentos/".$objeto->rfc."_dcurp.".$extension)){
                        $objeto->dcurp = $objeto->rfc."_dcurp.".$extension;
                    }else {
                      $dcurp = "0";
                      $objeto->dcurp ="";
                    }
                } else {
                  $dcurp = "1";
                  $objeto->dcurp = $_POST['d_4'];
                }
              }

              //Documento RFC si se agrego la foto se guarda en la carpeta documentos
                if(isset($_POST['drfc2'])){ $drfc = $_POST['drfc2']; }else{$drfc = ''; }

              if ($drfc == "") {
                if (isset($_FILES['drfc2']['name'])) {
                    $drfc = "1";
                    $file = explode(".", $_FILES['drfc2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['drfc2']['tmp_name'], "documentos/".$objeto->rfc."_drfc.".$extension)){
                        $objeto->drfc = $objeto->rfc."_drfc.".$extension;
                    }else {
                      $drfc = "0";
                      $objeto->drfc = $_POST['d_5'];
                    }
                } else {
                    $drfc = "0";
                    $objeto->drfc ="";
                }
              }else{
                if (isset($_FILES['drfc2']['name'])) {
                    $drfc = "1";
                    $file = explode(".", $_FILES['drfc2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['drfc2']['tmp_name'], "documentos/".$objeto->rfc."_drfc.".$extension)){
                        $objeto->drfc = $objeto->rfc."_drfc.".$extension;
                    }else {
                      $drfc = "0";
                      $objeto->drfc ="";
                    }
                } else {
                  $drfc = "1";
                  $objeto->drfc = $_POST['d_5'];
                }
              }

              //Documento NSS si se agrego la foto se guarda en la carpeta documentos
                if(isset($_POST['dns2'])){ $dns = $_POST['dns2']; }else{$dns = ''; }

              if ($dns == "") {
                if (isset($_FILES['dns2']['name'])) {
                    $dns = "1";
                    $file = explode(".", $_FILES['dns2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dns2']['tmp_name'], "documentos/".$objeto->rfc."_dns.".$extension)){
                        $objeto->dns = $objeto->rfc."_dns.".$extension;
                    }else {
                      $dns = "0";
                       $objeto->dns = $_POST['d_6'];
                    }
                } else {
                    $dns = "0";
                    $objeto->dns ="";
                }
              }else{
                if (isset($_FILES['dns2']['name'])) {
                    $dns = "1";
                    $file = explode(".", $_FILES['dns2']['name']);
                    $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['dns2']['tmp_name'], "documentos/".$objeto->rfc."_dns.".$extension)){
                        $objeto->dns = $objeto->rfc."_dns.".$extension;
                    }else {
                      $dns = "0";
                      $objeto->dns ="";
                    }
                } else {
                  $drfc = "1";
                  $objeto->dns = $_POST['d_6 '];
                }
              }
                 //Documentos verificados
            $objeto->documentos = "$dacta $dine $dcd $dcurp $drfc $dns";

              //Foto 1 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
              if (!empty($_POST['f_1'])) {
            //     echo "si f_1 tiene algo".$_POST['f_1']."<br>";
                if (!empty($_FILES['foto_4']['name'])) {
            // //       echo "si foto_4 tiene algo".$_FILES['foto_4']['name']."<br>";
                  $file = explode(".", $_FILES['foto_4']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_4']['tmp_name'], "fotos/".$objeto->rfc."_1.".$extension)){
             // // //          echo "si se pudo guardar<br>";
                        $objeto->foto_1 = $objeto->rfc."_1.".$extension;
                    }else {
             // // // //          echo "si no se pudo guardar el archivo"."<br>";
                      $objeto->foto_1 = $_POST['f_1'];
                    }
                }else {
            // // // // //       echo "si foto_4 no tiene algo".$_FILES['foto_4']['name']."<br>";
                  $objeto->foto_1 = $_POST['f_1'];
                }
              }else {
              //   echo "si f_1 no tiene algo".$_POST['f_1']."<br>";
                if (!empty($_FILES['foto_4']['name'])) {
             // //      echo "si foto_4 tiene algo".$_FILES['foto_4']['name']."<br>";
                  $file = explode(".", $_FILES['foto_4']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_4']['tmp_name'], "fotos/".$objeto->rfc."_1.".$extension)){
                        $objeto->foto_1 = $objeto->rfc."_1.".$extension;
                    }else {
              // // //         echo "si no se pudo guardar el archivo"."<br>";
                      $objeto->foto_1 = "user-default.png";
                    }
                }else {
               // // // //    echo "si foto_4 esta vacio ".$_FILES['foto_4']['name'];
                  $objeto->foto_1 = "user-default.png";
                }
              }

              //Foto 2 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
              if (!empty($_POST['f_2'])) {
                if (!empty($_FILES['foto_5']['name'])) {
                  $file = explode(".", $_FILES['foto_5']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_5']['tmp_name'], "fotos/".$objeto->rfc."_2.".$extension)){
                        $objeto->foto_2 = $objeto->rfc."_2.".$extension;
                    }else {
                      $objeto->foto_2 = $_POST['f_2'];
                    }
                }else {
                  $objeto->foto_2 = $_POST['f_2'];
                }
              }else {
                if (!empty($_FILES['foto_5']['name'])) {
                  $file = explode(".", $_FILES['foto_5']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_5']['tmp_name'], "fotos/".$objeto->rfc."_2.".$extension)){
                        $objeto->foto_2 = $objeto->rfc."_2.".$extension;
                    }else {
                      $objeto->foto_2 = "user-default.png";
                    }
                }else {
                  $objeto->foto_2 = "user-default.png";
                }
              }

              //Foto 3 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida
              if (!empty($_POST['f_3'])) {
                if (!empty($_FILES['foto_6']['name'])) {
                  $file = explode(".", $_FILES['foto_6']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_6']['tmp_name'], "fotos/".$objeto->rfc."_3.".$extension)){
                        $objeto->foto_3 = $objeto->rfc."_3.".$extension;
                    }else {
                      $objeto->foto_3 = $_POST['f_3'];
                    }
                }else {
                  $objeto->foto_3 = $_POST['f_3'];
                }
              }else {
                if (!empty($_FILES['foto_6']['name'])) {
                  $file = explode(".", $_FILES['foto_6']['name']);
                  $extension = array_pop($file);

                    if (move_uploaded_file($_FILES['foto_6']['tmp_name'], "fotos/".$objeto->rfc."_3.".$extension)){
                        $objeto->foto_3 = $objeto->rfc."_3.".$extension;
                    }else {
                      $objeto->foto_3 = "user-default.png";
                    }
                }else {
                  $objeto->foto_3 = "user-default.png";
                }
              }


              //_____________________________________________________________checar documentos ya cargados_______________________________________________________________
  //Foto 1 si se agrego la foto se guarda en la carpeta si no se pone la imagen predefinida




                if (isset($_POST['dacta'])) {
                    $dacta = $_POST['dacta'];
                } else {
                    $dacta = "0";
                }

                if (isset($_POST['dife'])) {
                    $dife = $_POST['dife'];
                } else {
                    $dife = "0";
                }

                if (isset($_POST['dcd'])) {
                    $dcd = $_POST['dcd'];
                } else {
                    $dcd = "0";
                }

                if (isset($_POST['dcurp'])) {
                    $dcurp = $_POST['dcurp'];
                } else {
                    $dcurp = "0";
                }

                if (isset($_POST['drfc'])) {
                    $drfc = $_POST['drfc'];
                } else {
                    $drfc = "0";
                }

                if (isset($_POST['dns'])) {
                    $dns = $_POST['dns'];
                } else {
                    $dns = "0";
                }

                if ($_POST['infonavit'] != "") {
                    $objeto->infonavit_dias = $_POST['dias'];
                    $objeto->infonavit_salario = $_POST['salario'];
                    $objeto->infonavit_aportacion = $_POST['aportacion'];
                    $objeto->infonavit_descuento = $_POST['descuento'];
                    $objeto->infonavit_dias = $_POST['dias'];
                    $objeto->infonavit_valor = $_POST['valor'];
                    $objeto->infonavit_amortizacion = $_POST['amortizacion'];
                    $objeto->infonavit_proporcion = $_POST['proporcion'];
                } else {
                    $objeto->infonavit_dias = 0;
                    $objeto->infonavit_salario = 0;
                    $objeto->infonavit_aportacion = 0;
                    $objeto->infonavit_descuento = 0;
                    $objeto->infonavit_dias = 0;
                    $objeto->infonavit_valor = 0;
                    $objeto->infonavit_amortizacion = 0;
                    $objeto->infonavit_proporcion = 0;
                }


                   $query=$crud->actualizar_Persona($objeto);

                if ($query) {
    echo "<script>location.href='../../main.php?module=personal&alert=2';</script>";
                }
            }
        }
    } elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query3 = mysqli_query($mysqli, "SELECT nombre FROM andamieros WHERE id='$_GET[id]'")
                                      or die('error: '.mysqli_error($mysqli));
            $data  = mysqli_fetch_assoc($query3);

            $query4 = mysqli_query($mysqli, "DELETE FROM andamieros WHERE id='$id'")
                                            or die('error '.mysqli_error($mysqli));
            if ($query4) {
                //insertar evento
                $tipo = "Eliminar personal";
                $nombre3 = $data['nombre'];
                $usuario = $_SESSION['username'];
                $query4 = mysqli_query($mysqli, "INSERT INTO eventos(tipo,nombre,usuario)
                                            VALUES('$tipo','$nombre3','$usuario')")
                                            or die('error '.mysqli_error($mysqli));

          echo "<script>location.href='../../main.php?module=personal&alert=3';</script>";
            }
        }
    }
}


?>
