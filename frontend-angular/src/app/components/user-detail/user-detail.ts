import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { UserService, User } from '../../services/user.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-user-detail',
  imports: [CommonModule, RouterModule ],
  templateUrl: './user-detail.html',
  styleUrl: './user-detail.scss',
})
export class UserDetailComponent {

  user: User | null = null;
  user$!: Observable<User>;

  constructor(
    private route: ActivatedRoute,
    private userService: UserService
  ) {}

  ngOnInit(): void {
  const idParam = this.route.snapshot.paramMap.get('id');
  console.log('ID PARAM:', idParam);

  const id = Number(idParam);
  console.log('ID NUMBER:', id);

  this.user$ = this.userService.getUser(id);
  }
}

