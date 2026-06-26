protoc-uam:
	protoc \
		--proto_path=src/proto/uam \
		--php_out=src/ \
		--grpc_out=src/ \
		--plugin=protoc-gen-grpc=grpc_php_plugin \
		uam_rpc.proto \
	&& mv src/Inexdigital/Enforcer/Grpc src/ \
	&& rm -rf src/Inexdigital