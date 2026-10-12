import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { AuthInterceptor } from './interceptores/auth.interceptor';
import { TiempoInterceptor } from './interceptores/tiempo.interceptor';

import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { AvisosListaComponent } from './avisos-lista/avisos-lista.component';
import { EntrarComponent } from './entrar/entrar.component';
import { AvisoNuevoComponent } from './aviso-nuevo/aviso-nuevo.component';
import { PracticaComponent } from './practica/practica.component';
import { AvisoDetalleComponent } from './aviso-detalle/aviso-detalle.component';
import { AvisoEditarComponent } from './aviso-editar/aviso-editar.component';

@NgModule({
  declarations: [
    AppComponent,
    AvisosListaComponent,
    EntrarComponent,
    AvisoNuevoComponent,
    PracticaComponent,
    AvisoDetalleComponent,
    AvisoEditarComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    AppRoutingModule
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: TiempoInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
