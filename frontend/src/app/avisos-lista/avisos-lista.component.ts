import { Component, OnDestroy, OnInit } from '@angular/core';
import { HttpErrorResponse } from '@angular/common/http';
import { SesionService } from '../servicios/sesion.service';
import { Subscription } from 'rxjs';

import { Aviso } from '../modelos/aviso';
import { AvisosService } from '../servicios/avisos.service';

@Component({
  selector: 'app-avisos-lista',
  templateUrl: './avisos-lista.component.html',
  styleUrls: ['./avisos-lista.component.css']
})
export class AvisosListaComponent implements OnInit, OnDestroy {
  avisos: Aviso[] = [];
  cargando = true;
  error = '';
  mensaje = '';
  mensajeOk = false;
  paginaActual = 1;
  paginaUltima = 1;
  totalAvisos = 0;
  private sesionSubscription?: Subscription;

  constructor(private avisosService: AvisosService, public sesion: SesionService) { }

  ngOnInit(): void {
    this.sesionSubscription = this.sesion.sesion$.subscribe(() => this.cargar(this.paginaActual));
    this.avisosService.cambios$.subscribe(() => this.cargar(this.paginaActual));
    this.cargar(this.paginaActual);
  }

  ngOnDestroy(): void {
    this.sesionSubscription?.unsubscribe();
  }

  cargar(pagina = 1): void {
    this.cargando = true;
    this.error = '';
    this.avisosService.pagina(pagina).subscribe({
      next: paginaAvisos => {
        this.avisos = paginaAvisos.avisos;
        this.paginaActual = paginaAvisos.actual;
        this.paginaUltima = paginaAvisos.ultima;
        this.totalAvisos = paginaAvisos.total;
        this.cargando = false;
      },
      error: () => {
        this.error = 'No pude hablar con Django. Revisa que la API siga corriendo en el puerto 8001.';
        this.cargando = false;
      }
    });
  }

  borrar(aviso: Aviso): void {
    this.mensaje = '';
    this.avisosService.borrar(aviso.id).subscribe({
      next: () => {
        this.avisos = this.avisos.filter(a => a.id !== aviso.id);
        this.mensaje = `204 · borraste "${aviso.titulo}"`;
        this.mensajeOk = true;
      },
      error: (e: HttpErrorResponse) => {
        this.mensaje = e.status === 403
          ? '403 · ese aviso no es tuyo. Lo decidió tu PostPolicy, no Angular.'
          : `${e.status} · tu API no lo borró`;
        this.mensajeOk = false;
      }
    });
  }
}
