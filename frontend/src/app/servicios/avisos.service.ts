import { Injectable } from '@angular/core';
import { HttpClient, HttpContext } from '@angular/common/http';
import { Observable, Subject, map, tap } from 'rxjs';
import { Aviso, Categoria, NuevoAviso, PaginaAvisos } from '../modelos/aviso';
import { SIN_TOKEN } from '../interceptores/auth.interceptor';

@Injectable({
  providedIn: 'root'
})
export class AvisosService {
  private cambiosSubject = new Subject<void>();
  readonly cambios$ = this.cambiosSubject.asObservable();

  constructor(private http: HttpClient) { }

  listar(): Observable<Aviso[]> {
    return this.http.get<{ results: Aviso[] }>('/api/avisos/', {
      context: new HttpContext().set(SIN_TOKEN, true)
    }).pipe(
      map(respuesta => respuesta.results)
    );
  }

  pagina(numero: number): Observable<PaginaAvisos> {
    return this.http.get<{ count: number; results: Aviso[] }>(`/api/avisos/?page=${numero}`, {
      context: new HttpContext().set(SIN_TOKEN, true)
    }).pipe(
      map(respuesta => ({
        avisos: respuesta.results,
        actual: numero,
        ultima: Math.max(1, Math.ceil(respuesta.count / 10)),
        total: respuesta.count
      }))
    );
  }

  uno(id: number): Observable<Aviso> {
    return this.http.get<Aviso>(`/api/avisos/${id}/`, {
      context: new HttpContext().set(SIN_TOKEN, true)
    });
  }

  listarCategorias(): Observable<Categoria[]> {
    return this.http.get<Categoria[]>('/api/categorias/', {
      context: new HttpContext().set(SIN_TOKEN, true)
    });
  }

  crear(aviso: NuevoAviso): Observable<Aviso> {
    return this.http.post<Aviso>('/api/avisos/', aviso);
  }

  borrar(id: number): Observable<void> {
    return this.http.delete<void>(`/api/avisos/${id}/`);
  }

  actualizar(id: number, aviso: NuevoAviso): Observable<Aviso> {
    return this.http.put<Aviso>(`/api/avisos/${id}/`, aviso).pipe(
      tap(() => this.cambiosSubject.next())
    );
  }

}
